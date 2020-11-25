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
    private $command;

    private $PID;


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
                $this->PID = $uniqueID;
                break;
        }

    }

    private function runCom(){
        $command = "";
        switch($this->binary){ //TODO:there is very little error handling involved with spawning these processes
            case "gobs":
                $command = 'nice -n 10 '. $this->binaryPath. ' '. $this->filePath . ' '.$this->outputFile . ' '.($this->params !=null ? $this->params : "1 1 1") .' > /dev/null 2>&1 &';
                break;
            case "x":
                $command = 'nice -n 10 python3 '. $this->binaryPath. ' ' . $this->filePath . ' '. $this->outputFile .' ' .($this->params !=null ? $this->params : "weight").' > /dev/null 2>&1 &' ;
                break;
        }
        $descriptorspec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
        ];
        $proc = proc_open($command, $descriptorspec, $pipes);
        $proc_details = proc_get_status($proc);
        $pid = (int)$proc_details['pid'] +1;
        //known issue with proc_open, returns pid-1

        $this->PID = $pid;
        $this->uniqueID = $pid;
    }

    public function getUniqueID(){
        return $this->uniqueID;
    }

    public function status(){
        $command = 'ps -p '.$this->uniqueID. ' -o etime';
        exec($command,$op);
        //will return 'elapsed <time>'  or just 'elapsed' if the process is not running
        if (!isset($op[1]))return false;
        else return true;
    }

    //should only be called after status is successful
    public function elapsed(){
        $command = 'ps -p '.$this->uniqueID. ' -o etime';
        exec($command,$op);
        return $op[1];
    }

    public function getRunParams(){
        switch($this->binary){
            case "gobs":
                $splitParams = explode(" ",$this->params);
                return "Normalization: " . $splitParams[0]. " Alpha Value: " . $splitParams[1].
                    " Vector History Length: " . $splitParams[2]. " Number of Directions: " . $splitParams[3].
                    " Statistical Comparison: " . $splitParams[4];
            case "x":
                $splitParams = explode(" ",$this->params);
                return "Scaling Option: " . $splitParams[0]. " Grouping Method: " . $splitParams[1].
                    " Layout: " . $splitParams[2]. " Scale Multiplier: " . $splitParams[3];

        }
    }

    public function stop(){
        $command = 'kill '.$this->uniqueID;
        exec($command);
        if ($this->status() == false)return true;
        else return false;
    }
}