<?php

class PaymentLogger {
    private $logFile;

    public function __construct($logFile = 'payment_log.txt') {
        $this->logFile = $logFile;
    }

    public function log($message, $type = 'INFO') {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$type] $message" . PHP_EOL;
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

    public function logArray($data, $type = 'INFO') {
        $message = print_r($data, true);
        $this->log($message, $type);
    }
}
