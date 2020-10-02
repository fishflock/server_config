<?php
/* An easy way to keep in track of external processes.
* @author: Peec
*/
class Process{
    private $uid;
    private $fileName;
    private $filePath;
    private $binaryPath = "/var/www/html/GOBS/gobs";
    private $uniqueID;

    public function __construct($processStage, $uid, $file_name=null, $spawn_time=null, $uniqueID=null ){

        $this->uid = $uid;

        switch ($processStage){
            case "create":
                $this->fileName = $file_name;
                $this->filePath = "/var/www/html/hidden/uploads/" . $this->uid .'/'. $file_name;
                $this->uniqueID = $uid.$spawn_time;
                $this->runCom();
                break;

            case "check":
                $this->fileName = $file_name;
                $this->uniqueID = $uniqueID;
                break;
        }
    }

    private function runCom(){
        $command = 'bash -c "exec -a ' .$this->uniqueID. 'while true > /dev/null 2>&1 & $!"';
        exec($command ,$op);
    }
    //$command = 'nohup '.$this->binaryPath.' '. $this->filePath .' > /dev/null 2>&1 & echo $!';
    //$command = 'nohup ls -la > /dev/null 2>&1 & echo $!';

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