<?php
class Process{
    private $uid; //user ID
    private $fileName; //input file name
    private $filePath; //input file path
    private $outputFile; //output file path
    private $binaryPath; //path to executable
    private $binary; //gobs for GOBS, x for NetworkX
    private $uniqueID;
    private $params;//space separated string with cmd line params


    public function __construct($processStage, $uid, $fileName=null, $spawnTime=null, $uniqueID=null, $binary=null, $outputFile=null, $params=null){

        $this->uid = $uid;
        $this->outputFile = $outputFile;
        $this->params = $params;
        $this->binary = $binary;
        switch($binary){
            case "gobs":
                $this->binaryPath = $_SERVER['DOCUMENT_ROOT']."/hidden/scripts/gobs";
                $this->filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $this->uid .'/'. $fileName;
                break;
            case "x":
                $this->binaryPath = $_SERVER['DOCUMENT_ROOT']."/hidden/scripts/nX";
                $this->filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $this->uid .'/gobs_output/'. $fileName;
                break;
        }


        switch ($processStage){
            case "create":
                $this->fileName = $fileName;
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
                $command = 'bash -c "exec -a ' .$this->uniqueID. ' '. $this->binaryPath. ' '. $this->filePath . ' '.$this->outputFile . ' '.($this->params !=null ? $this->params : "1 1 1") .' & $!"';
                break;
            case "x":
                $command = 'bash -c "exec -a ' .$this->uniqueID. ' python3 '. $this->binaryPath. ' ' . $this->filePath . ' '. $this->outputFile .' & $!"' ;
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