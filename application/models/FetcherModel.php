<?php
class FetcherModel extends CI_Model
{
    public function fetchAnnales($categorie_id, $annale_year)
    {
        $fiches =  $this->db->query("SELECT * FROM fiches INNER JOIN categorie ON fiches.categorie_id=categorie.categorie_id WHERE fiches.categorie_id='{$categorie_id}' AND fiches_contenu LIKE '%{$annale_year}%'")->result();
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='{$categorie_id}'")->result();
        if (count($section) > 0) {
            for ($i = 0; $i < count($section); $i++) {
                $section[$i]->fiches_contenu = $fiches[0]->fiches_contenu;
                $section[$i]->categorie_nom = $fiches[0]->categorie_nom;
                $data_limit = 10;
                switch ($section[$i]->section_nom) {
                    case "Français":
                        $data_limit = 16;
                        break;
                    case "Culture générale":
                        $data_limit = 15;
                        break;
                    case "Mathématiques":
                        $data_limit = 13;
                        break;
                    case "Logique":
                        $data_limit = 10;
                        break;
                }
                $data_question = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY RAND() LIMIT {$data_limit}")->result();

                for ($j = 0; $j < count($data_question); $j++) {
                    $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data_question[$j]->question_id}'")->result();
                    if (count($data_reponses) > 0) {
                        $data_question[$j]->reponses = $data_reponses;
                    }
                }
                $section[$i]->questions = $data_question;
            }
            return $section;
        } else {
            return 0;
        }
    }

    public function fetchAttache()
    {
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='24'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture administrative et juridique":
                    /**
                     *  Total: 60 questions
                     *  46 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  2 -> IGPDE
                     *  2 -> Vuibert
                     *  1 -> Gualino 1
                     *  1 -> Gualino 2
                     *  1 -> Gualino 3
                     *  1 -> Gualino 4
                     *  1 -> Studyrama 1
                     *  1 -> Studyrama 2
                     *  1 -> Studyrama 3
                     *  1 -> Studyrama 4
                     *  1 -> Studyrama 5
                     *  1 -> Studyrama 6
                     *  
                     * 
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 46")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 8")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 6")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 8")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 8")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 8")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 2")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 2")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 2%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino3 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 3' ORDER BY RAND() LIMIT 1")->result();
                    $gualino4 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 4' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 2%' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama3 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 3%' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama4 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 4' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama5 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 5%' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama6 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 6%' ORDER BY RAND() LIMIT 1")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($gualino2) > 0) {

                        for ($j = 0; $j < count($gualino2); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino2[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino2[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino2[$j]);
                        }
                    }

                    if (count($gualino3) > 0) {

                        for ($j = 0; $j < count($gualino3); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino3[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino3[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino3[$j]);
                        }
                    }

                    if (count($gualino4) > 0) {

                        for ($j = 0; $j < count($gualino4); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino4[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino4[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino4[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }
                    if (count($studyrama2) > 0) {

                        for ($j = 0; $j < count($studyrama2); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama2[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama2[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama2[$j]);
                        }
                    }

                    if (count($studyrama3) > 0) {

                        for ($j = 0; $j < count($studyrama3); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama3[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama3[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama3[$j]);
                        }
                    }

                    if (count($studyrama4) > 0) {

                        for ($j = 0; $j < count($studyrama4); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama4[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama4[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama4[$j]);
                        }
                    }

                    if (count($studyrama5) > 0) {

                        for ($j = 0; $j < count($studyrama5); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama5[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama5[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama5[$j]);
                        }
                    }

                    if (count($studyrama6) > 0) {

                        for ($j = 0; $j < count($studyrama6); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama6[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama6[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama6[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Finances publiques":
                    /**
                     *  Total: 20 questions
                     *  10 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  1 -> IGPDE
                     *  1 -> Vuibert
                     *  3 -> Gualino 1/2/3/4
                     *  5 -> Studyrama 1/2/3/4/5/6
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 10")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 2")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 1")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 3")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 5")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Les institutions européennes":
                    /**
                     *  Total: 20 questions
                     *  10 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  1 -> IGPDE
                     *  1 -> Vuibert
                     *  3 -> Gualino 1/2/3/4
                     *  5 -> Studyrama 1/2/3/4/5/6
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 10")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 2")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 1")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 3")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 5")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Culture numérique":
                    /**
                     *  Total: 20 questions
                     *  10 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  1 -> IGPDE
                     *  1 -> Vuibert
                     *  3 -> Gualino 1/2/3/4
                     *  5 -> Studyrama 1/2/3/4/5/6
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 10")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 2")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 1")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 3")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 5")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }


        return $section;
    }



    public function getDataForRevision($email)
    {
        $data = $this->db->query("SELECT * FROM favoris WHERE clients_id='{$email}' AND type='attache_admin' ORDER BY id_favoris ASC")->result();
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='24'")->result();
        $data_to_compare = [];
        for ($kk = 0; $kk < count($data); $kk++) {
            array_push($data_to_compare, $data[$kk]->question_id);
        }

        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture administrative et juridique":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }


                    $section[$i]->questions = $array_questions;


                    break;
                case "Finances publiques":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Les institutions européennes":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Culture numérique":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }

        return $section;
    }

    public function fetchAttacheLastest($date)
    {
        $date = "Annale $date";
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='24'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture administrative et juridique":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $qst[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Finances publiques":

                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $qst[$j]);
                        }
                    }

                    $section[$i]->questions = $array_questions;
                    break;
                case "Les institutions européennes":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $qst[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Culture numérique":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {
                                $qst[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $qst[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }


        return $section;
    }

    public function fetchAttacheSaves($code)
    {
        $the_code = $code;
        $the_datas = $this->db->query("SELECT * FROM session_saves WHERE the_code='$code'")->result();
        $questions = json_decode($the_datas[0]->the_datas);
        // var_dump($questions) ;
        // die() ;
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='24'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture administrative et juridique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();
                    $array_questions = [];
                    $newData = [];
                    if (count($data2020_0) > 0) {
                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $newData[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                    }
                    $section[$i]->questions = $array_questions;
                    break;
                case "Finances publiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();
                    $array_questions = [];
                    $newData = [];
                    if (count($data2020_0) > 0) {
                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $newData[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                    }
                    $section[$i]->questions = $array_questions;
                    break;
                case "Les institutions européennes":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();
                    $array_questions = [];
                    $newData = [];
                    if (count($data2020_0) > 0) {
                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $newData[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                    }
                    $section[$i]->questions = $array_questions;
                    break;
                case "Culture numérique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();
                    $array_questions = [];
                    $newData = [];
                    if (count($data2020_0) > 0) {
                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $newData[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                    }
                    $section[$i]->questions = $array_questions;
                    break;
            }
        }


        return $section;
    }
}
