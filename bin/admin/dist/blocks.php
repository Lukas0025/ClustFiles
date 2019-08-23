<?php
    class blocks {

        public function usersTable($cf, $class = "") {
            $usersname = $cf->getUsersNames();

            //create table array
            $table = [
                [ //header
                    "#",
                    "name",
                    "dir",
                    "size",
                    "admin",
                    ""
                ]
            ];

            foreach ($usersname as $user) {
                array_push($table, [
                    '#',
                    $user,
                    '/data/' . $user,
                    $cf->userSize($user),
                    $cf->isAdmin($user) ? "<span class='badge badge-success'>yes</span>" : "<span class='badge badge-danger'>no</span>",
                    
                        "<a class='btn btn-primary btn-sm' href='#'>
                            <i class='fa fa-folder'></i>
                            View
                        </a>
                        <a class='btn btn-info btn-sm' href='user.php?user=$user'>
                            <i class='fa fa-pencil-alt'></i>
                            Edit
                        </a>
                        <a class='btn btn-danger btn-sm' href='#'>
                            <i class='fa fa-trash'></i>
                            Delete
                        </a>"
                    
                ]);
            }

            return $this->table($table, $class);
        }

        public function table($array2D, $class = "") {
            $html = "<table class='table $class'><thead><tr>";

            //first line as header
            foreach ($array2D[0] as $col) {
                $html .= "<th>$col</th>";
            }

            unset($array2D[0]);

            $html .= "</tr></thead><tbody>";

            //body now
            foreach ($array2D as $row) {
                $html .= "<tr>";
                
                foreach ($row as $col) {
                    $html .= "<td>$col</td>";
                }

                $html .= "</tr>";
            }

            $html .= "</tbody></table>";

            return $html;
        }

        public function card($cardtitle, $content, $cardtools = "", $bodyclass = "p-0") {
            return "<div class='card'>
                        <div class='card-header'>
                            <h3 class='card-title'>$cardtitle</h3>
                    
                            <div class='card-tools'>
                                $cardtools
                            </div>
                        </div>
                        <div class='card-body $bodyclass'>
                            $content
                        </div>
                    </div>";
        }

    }
