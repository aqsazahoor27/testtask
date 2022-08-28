<?php

namespace App\Http\GlobalHelper\StreamBase;

class LocalVideoStream {
    
    private $path = "";
    private $stream = "";
    private $buffer = 1024 * 8;
    private $start  = 0;
    private $end    = 0;
    private $reqSize = 5 * 1000000; // 5 MB
    private $initialChunk = 2 * 1000000;
    private $size   = 0;
 
    public function _setPath($filePath) 
    {
        $this->path = $filePath;
        $this->size = filesize($this->path);
    }
     
    /**
     * Open stream
     */
    private function open()
    {
        if (!($this->stream = fopen($this->path, 'rb'))) {
            return $this->showError();
        }
         
    }
    
    /**
     * Get MIME Type
     */
    private function getMime()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $this->path);
        finfo_close($finfo);
        return $mimetype;
    }
     
    /**
     * Set proper header to serve the video content
     */
    private function setHeader()
    {
        ob_get_clean();
        header("Content-Type: " . $this->getMime());
        header("Cache-Control: max-age=2592000, public");
        // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        // header("Cache-Control: post-check=0, pre-check=0", false); //for testing headers
        header("Pragma: no-cache");
        header("Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . ' GMT');
        header("Last-Modified: ".gmdate('D, d M Y H:i:s', @filemtime($this->path)) . ' GMT' );
        
        $size = $this->size - 1;
        
        header("Accept-Ranges: 0-".$size);
        // header("Accept-Ranges: bytes");
  
        $c_start = 0;

        list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);

        if ($range == '-') {
            $c_start = $this->size - substr($range, 1);
        }else{
            $range = explode('-', $range);
            $c_start = $range[0];

            if($c_start == '0'){
                $this->reqSize = $this->initialChunk;
            }
        }

        $this->start = $c_start;
        $this->end = $c_start + $this->reqSize;

        $length = $this->reqSize;

        if($this->end > $this->size){
            $this->end = $size;
            $length = $this->size - $this->start;
        }
        
        fseek($this->stream, $this->start);
        header('HTTP/1.0 206 Partial Content');
        header("Content-Length: ".$length);
        header("Content-Range: bytes $this->start-$this->end/".$this->size);
         
    }
    
    /**
     * close curretly opened stream
     */
    private function end()
    {
        fclose($this->stream);
        exit;
    }
     
    /**
     * perform the streaming of calculated range
     */
    private function stream()
    {
        $i = $this->start;
        while(!feof($this->stream) && $i <= $this->end) {
            $bytesToRead = $this->buffer;
            if(($i+$bytesToRead) > $this->end) {
                $bytesToRead = $this->end - $i + 1;
            }
            set_time_limit(0);
            $data = fread($this->stream, $bytesToRead);
            echo $data;
            flush();
            $i += $bytesToRead;
        }

    }
     
    /**
     * Start streaming video content
     */
    function start()
    {
        $this->open();
        $this->setHeader();
        $this->stream();
        $this->end();
    }

    private function showError()
    {
        return [
            'status' => false,
            'msg' => "unable to process request",
        ];
    }

}