<?php
class Process{
    private $uid;
    private $fileName;
    private $filePath;
    private $outputFile;
    private $binaryPath;
    private $binary;
    private $uniqueID;


    public function __construct($processStage, $uid, $fileName=null, $spawnTime=null, $uniqueID=null, $binary=null, $outputFile=null){

        $this->uid = $uid;
        $this->outputFile = $outputFile;

        $this->binary = $binary;
        switch($binary){
            case "gobs":
                $this->binaryPath = $_SERVER['DOCUMENT_ROOT']."/hidden/scripts/gobs";
                break;
            case "x":
                $this->binaryPath = $_SERVER['DOCUMENT_ROOT']."/hidden/scripts/nX";
                break;
        }


        switch ($processStage){
            case "create":
                $this->fileName = $fileName;
                $this->filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $this->uid .'/'. $fileName;
                $this->uniqueID = $uid.$spawnTime;
                $this->runCom();
                break;

            case "check":
                $this->fileName = $fileName;
                $this->uniqueID = $uniqueID;
                break;
        }

    }

    private function runCom(){
        $command = "";
        switch($this->binary){
            case "gobs":
                $command = 'bash -c "exec -a ' .$this->uniqueID. ' '. $this->binaryPath. ' '. $this->filePath . ' '.$this->outputFile .' 1 1 1 > /var/www/html/test_output.txt 2>&1 & $!"';
                include_once('../phpHelpers/debug.php');
                debugToConsole($command);
                break;
            case "x":
                $command = 'bash -c "exec -a ' .$this->uniqueID. ' '. $this->binaryPath. '  > /dev/null 2>&1 & $!"';
                break;
        }
        exec($command ,$op);
    }

    public function getUniqueID(){
        return $this->uniqueID;
    }

    public function status(){
        $command = 'pgrep '.$this->uniqueID. ' | xargs --no-run-if-empty ps fp';
        exec($command,$op);
        if (!isset($op[1]))return false;
        else return true;
    }


    public function stop(){
        $command = 'pkill -f '.$this->uniqueID;
        exec($command);
        if ($this->status() == false)return true;
        else return false;
    }
}