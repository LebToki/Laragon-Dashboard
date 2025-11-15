<footer class="d-footer">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <p class="mb-0"><?php echo $translations['default_footer'] ?? "&copy; 2024 " . htmlspecialchars(date('Y')) . ", Tarek Tarabichi"; ?></p>
        </div>
        <div class="col-auto">
            <p class="mb-0"><?php echo $translations['made_with_love'] ?? "Made with <span style=\"color: #e25555;\">&hearts;</span> and powered by Laragon"; ?></p>
        </div>
        <?php if (defined('APP_DEBUG') && APP_DEBUG): ?>
        <div class="col-auto">
            <?php 
            global $startTime, $startMemory;
            $endTime = microtime(true);
            $endMemory = memory_get_usage(true);
            
            // Check if variables are set, otherwise use defaults
            if (!isset($startTime)) {
                $startTime = $endTime;
            }
            if (!isset($startMemory)) {
                $startMemory = $endMemory;
            }
            
            $executionTime = round(($endTime - $startTime) * 1000, 2);
            $memoryUsed = round(($endMemory - $startMemory) / 1024, 2);
            echo "<p class='mb-0 text-sm'>Page loaded in {$executionTime}ms | Memory: {$memoryUsed}KB</p>";
            ?>
        </div>
        <?php endif; ?>
    </div>
</footer>

