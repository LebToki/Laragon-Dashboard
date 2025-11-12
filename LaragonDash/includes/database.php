<?php
/**
 * Database Helper for Laragon Dashboard
 * Provides database connection and query utilities
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/logger.php';

class DatabaseHelper {
    private static $connection = null;
    private static $instance = null;
    
    private function __construct() {
        $this->connect();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function connect() {
        try {
            $dsn = "mysql:host=" . MYSQL_HOST . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            self::$connection = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD, $options);
            DashboardLogger::info("Database connection established");
            
        } catch (PDOException $e) {
            DashboardLogger::error("Database connection failed: " . $e->getMessage());
            self::$connection = null;
        }
    }
    
    public function getConnection() {
        if (self::$connection === null) {
            $this->connect();
        }
        return self::$connection;
    }
    
    public function isConnected() {
        return self::$connection !== null;
    }
    
    public function getServerInfo() {
        if (!$this->isConnected()) {
            return null;
        }
        
        try {
            $stmt = self::$connection->query("SELECT VERSION() as version");
            $result = $stmt->fetch();
            return $result['version'] ?? 'Unknown';
        } catch (PDOException $e) {
            DashboardLogger::error("Failed to get MySQL version: " . $e->getMessage());
            return 'Error';
        }
    }
    
    public function getDatabases() {
        if (!$this->isConnected()) {
            return [];
        }
        
        try {
            $stmt = self::$connection->query("SHOW DATABASES");
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            DashboardLogger::error("Failed to get databases: " . $e->getMessage());
            return [];
        }
    }
    
    public function getTableCount($database) {
        if (!$this->isConnected()) {
            return 0;
        }
        
        try {
            $stmt = self::$connection->prepare("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = ?");
            $stmt->execute([$database]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            DashboardLogger::error("Failed to get table count for database $database: " . $e->getMessage());
            return 0;
        }
    }
    
    public function executeQuery($query, $params = []) {
        if (!$this->isConnected()) {
            return false;
        }
        
        try {
            $stmt = self::$connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            DashboardLogger::error("Query execution failed: " . $e->getMessage(), [
                'query' => $query,
                'params' => $params
            ]);
            return false;
        }
    }
    
    public function getQueryResult($query, $params = []) {
        $stmt = $this->executeQuery($query, $params);
        return $stmt ? $stmt->fetchAll() : [];
    }
    
    public function getSingleResult($query, $params = []) {
        $stmt = $this->executeQuery($query, $params);
        return $stmt ? $stmt->fetch() : null;
    }
    
    public function getServerStatus() {
        if (!$this->isConnected()) {
            return [
                'status' => 'disconnected',
                'version' => 'Unknown',
                'uptime' => 'Unknown',
                'connections' => 0
            ];
        }
        
        try {
            $status = $this->getSingleResult("SHOW STATUS");
            $variables = $this->getSingleResult("SHOW VARIABLES LIKE 'version'");
            
            return [
                'status' => 'connected',
                'version' => $variables['Value'] ?? 'Unknown',
                'uptime' => $this->getSingleResult("SHOW STATUS LIKE 'Uptime'")['Value'] ?? 'Unknown',
                'connections' => $this->getSingleResult("SHOW STATUS LIKE 'Connections'")['Value'] ?? 0
            ];
        } catch (PDOException $e) {
            DashboardLogger::error("Failed to get server status: " . $e->getMessage());
            return [
                'status' => 'error',
                'version' => 'Unknown',
                'uptime' => 'Unknown',
                'connections' => 0
            ];
        }
    }
}
?>
