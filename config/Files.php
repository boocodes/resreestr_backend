<?php
    class Files{


        public function get_files_size($file){
            if(!file_exists($file)) return false;
            return round(filesize($file) * 0.001); // kbites
        }

        public function getDirectorySize(string $folderPath){
            $files = scandir($folderPath);
            if(!file_exists($files)) return 0;
            unset($files[0], $files[1]);
            $size = 0;
            foreach ($files as $file) {
                if (file_exists($folderPath . '/' . $file)) {
                    $size += filesize($folderPath . '/' . $file);
                    if (is_dir($folderPath . '/' . $file)) {
                        $size += $this->getDirectorySize($folderPath . '/' . $file);
                    }
                }

            }

            return round($size * 0.001); //kbites
        }

    }


?>