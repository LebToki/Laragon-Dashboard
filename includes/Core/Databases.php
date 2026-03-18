<?php

namespace LaragonDashboard\Core;

/**
 * Databases Class
 * Version: 1.0.0
 * Handles MySQL database management
 */
class Databases {
    private static $connection = null;

    /**
     * Get MySQL connection
     */
    private static function getConnection() {
        if (self::$connection === null) {
            $host = defined('MYSQL_HOST') ? MYSQL_HOST : '127.0.0.1';
            $user = defined('MYSQL_USER') ? MYSQL_USER : 'root';
            $pass = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : ''; 
            
            // Try to connect
            try {
                self::$connection = new \mysqli($host, $user, $pass);
                if (self::$connection->connect_error) {
                    throw new \Exception("Connection failed: " . self::$connection->connect_error);
                }
            } catch (\Exception $e) {
                if (class_exists('\\LaragonDashboard\\Core\\Logger')) {
                    \LaragonDashboard\Core\Logger::error("MySQL Connection Error: " . $e->getMessage());
                }
                return null;
            }
        }
        return self::$connection;
    }

    /**
     * List all databases
     */
    public static function list() {
        $db = self::getConnection();
        if (!$db) return [];

        // ⚡ Bolt: Replaced N+1 queries with a single query to get database names and sizes efficiently.
        $query = "
            SELECT
                schema_name AS 'name',
                COALESCE(SUM(t.data_length + t.index_length) / 1024 / 1024, 0) AS 'size'
            FROM
                information_schema.schemata s
            LEFT JOIN
                information_schema.tables t ON s.schema_name = t.table_schema
            WHERE
                s.schema_name NOT IN ('information_schema', 'mysql', 'performance_schema', 'sys')
            GROUP BY
                s.schema_name
        ";

        $result = $db->query($query);
        $databases = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $databases[] = [
                    'name' => $row['name'],
                    'size' => round(floatval($row['size']), 2)
                ];
            }
        }
        return $databases;
    }

    /**
     * Create a database
     */
    public static function create($name) {
        $db = self::getConnection();
        if (!$db) return false;

        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $name);
        if (empty($name)) return false;

        return $db->query("CREATE DATABASE `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    /**
     * Drop a database
     */
    public static function drop($name) {
        $db = self::getConnection();
        if (!$db) return false;

        $name = $db->real_escape_string($name);
        return $db->query("DROP DATABASE `$name` ");
    }

    /**
     * Backup a database
     */
    public static function backup($name) {
        $db = self::getConnection();
        if (!$db) return false;

        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $name);
        if (empty($name)) return false;

        // Ensure backup directory exists
        $backupDir = dirname(dirname(__DIR__)) . '/backups';
        if (!is_dir($backupDir)) {
            @mkdir($backupDir, 0755, true);
        }

        $filename = $name . '_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupDir . '/' . $filename;

        // Find mysqldump
        $laragonRoot = \LaragonDashboard\Core\System::getLaragonRoot();
        $mysqlDir = $laragonRoot . '/bin/mysql';
        
        // Find the first mysqldump.exe in the mysql directory
        $it = new \RecursiveDirectoryIterator($mysqlDir);
        $dumpPath = null;
        foreach (new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getFilename() === 'mysqldump.exe') {
                $dumpPath = $file->getPathname();
                break;
            }
        }

        if (!$dumpPath) {
            // Fallback to searching the path
            $dumpPath = 'mysqldump';
        }

        $command = "\"$dumpPath\" --user=root --result-file=\"$filepath\" \"$name\"";
        
        exec($command, $output, $returnVar);

        if ($returnVar === 0 && file_exists($filepath)) {
            return [
                'success' => true,
                'filename' => $filename,
                'path' => $filepath,
                'size' => round(filesize($filepath) / 1024, 2) . ' KB'
            ];
        }

        return false;
    }
}
