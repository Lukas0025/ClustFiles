<?php
class clusterFiles {
    public function isUser($name) {
        return is_dir(
            $this->safePath('/data/' . $name)
        );
    }

    public function isAdmin($name) {
        if ($this->isUser($name)) {
            return $this->getUser($name)["admin"];
        }

        return false;
    }

    public function addUser($name, $pass, $isadmin = false) {
        if (!$this->isUser($name)) {
            mkdir(
                $this->safePath('/data/' . $name)
            );

            $user = [
                'pass' => password_hash($pass, PASSWORD_DEFAULT),
                'admin' => $isadmin
            ];

            $this->saveToFile(
                $this->safePath('/data/' . $name . '/user'), 
                $user
            );
        }

        return false;
    }

    public function startsWith($haystack, $needle) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public function getRandomBackground() {
        $files = glob('/var/www/data/img/backgrounds/*.*');
        $file = array_rand($files);
        return "img/backgrounds/" . basename($files[$file]);
    }

    public function safePath($relativePath) {
        /*if (!$this->startsWith(
                realpath($relativePath),
                '/data/'
            )) {

            die("patch injection detect");
        }*/

        return $relativePath;
    }

    public function saveToFile($file, $data) {
        file_put_contents(
            $file,
            serialize($data)
        );
    }

    public function getFromFile($file) {
        return unserialize(
            file_get_contents($file)
        );
    }

    public function getLoginedUser() {
        $name = $this->getToken($_COOKIE['token']);

        if (!is_null($name)) {
            $user = $this->getUser($name);
            $user['name'] = $name;

            return $user;
        }

        return null;
    }

    public function getUser($name) {
        return $this->getFromFile(
            $this->safePath('/data/' . $name . '/user')
        );
    }

    public function getTokens() {
        return $this->getFromFile('/data/tokens');
    }

    public function getUserPath($name) {
        return $this->safePath('/data/' . $name . '/files');
    }

    public function getToken($tokenname) {
        $tokens = $this->getTokens();
        $return = null;
        
        foreach ($tokens['tokens'] as $id => $token) {
            $interval = $token['time']->diff(new DateTime());
            if ($interval->days > 1) {
                unset($tokens['tokens'][$id]);
            } else if ($token['name'] == $tokenname) {
                $return = $token['data'];
            }
        }

        $this->saveToFile('/data/tokens', $tokens);

        return $return;
    }

    public function delToken($tokenname) {
        $tokens = $this->getTokens();
        $return = false;
        
        foreach ($tokens['tokens'] as $id => $token) {
            unset($tokens['tokens'][$id]);
            $return = true;
            break;
        }

        $this->saveToFile('/data/tokens', $tokens);

        return $return;
    }

    public function logout() {
        $this->delToken($_COOKIE['token']);
        unset($_COOKIE['token']); 
        setcookie('token', null, -1); 
    }

    public function login($name, $pass) {
        $user = $this->getUser($name);

        if ($user !== false && password_verify($pass, $user['hash'])) {
            setcookie("token", $this->setToken($name));
            return true;
        }

        return false;
    }

    public function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function setToken($data) {
        $tokens = $this->getTokens();
        $id = $tokens['id'] + 1;
        $name = $id . $this->generateRandomString();
        
        array_push($tokens['tokens'], [
            'name' => $name,
            'data' => $data,
            'time' => new DateTime()
        ]);

        $tokens['id'] = $id;
        $this->saveToFile('/data/tokens', $tokens);

        return $name;
    }
}