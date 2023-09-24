<nav class="navbar navbar-expand-lg bg-light" style="height: 70px;">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>" style="font-weight: bold;font-size:25px">CAP-QCM</a>
        <ul class="navbar-nav ml-auto" style="position: relative;">
            <li class="nav-item">
                <a class="nav-link" href="#" style="padding-left: 15px;padding-top: 12px;" data-bs-toggle="modal" data-bs-target="#modalAide">Aide</span></a>
            </li>
        </ul>

    </div>
</nav>

<span id="parametters" data-categorie="<?php echo $categorie; ?>" data-mode="<?php echo $mode; ?>" data-section="<?php echo $section; ?>" data-retardateur="<?php echo $retardateur; ?>" data-chrono="<?php echo $chrono; ?>" data-note="<?php echo $note; ?>" data-bonneReponse="<?php echo $bonneReponse ?>" data-mauvaiseReponse="<?php echo $mauvaiseReponse; ?>" data-absenceReponse="<?php echo $absenceReponse; ?>" data-temps="<?php echo $temps; ?>"></span>
<span class="d-none" data-timer="<?php echo $temps; ?>" id="timer"></span>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-3">
                <div class="accordion shadow" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Sections
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse show collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <?php for ($i = 0; $i < count($donnees_qcm); $i++) : ?>
                                        <?php
                                        $d_none_section = "d-none";
                                        // var_dump(count($donnees_qcm[$i]->questions)) ;
                                        if (count($donnees_qcm[$i]->questions) > 0) {
                                            $d_none_section = "";
                                        }
                                        ?>
                                        <li class="<?php echo $d_none_section; ?>">


                                            <a href="#" data-section="<?php echo $donnees_qcm[$i]->section_nom; ?>" class="text-muted section-menu-anchor <?php echo $d_none_section; ?> <?php if ($donnees_qcm[$i]->section_nom == $section) {
                                                                                                                                                                                                echo 'activated';
                                                                                                                                                                                            } ?>"><?php echo $donnees_qcm[$i]->section_nom; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Liste de questions
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php for ($d = 0; $d < count($donnees_qcm); $d++) : ?>
                                    <?php
                                    $afficheur = "d-none";

                                    if ($donnees_qcm[$d]->section_nom == $section) {
                                        $afficheur = "";
                                    }
                                    ?>
                                    <ul data-section="<?php echo $donnees_qcm[$d]->section_nom; ?>" class="<?php echo $afficheur; ?> qst_list" style="height: 300px; overflow-y: auto;scrollbar-width: thin;-webkit-scrollbar-width: thin; padding-left:0px ;">
                                        <?php for ($l = 0; $l < count($donnees_qcm[$d]->questions); $l++) : ?>
                                            <?php $questions_reponses = $donnees_qcm[$d]->questions; ?>
                                            <li style="font-size: 13px;font-weight:bold ;" class="mt-2">
                                                <a data-tracer="<?php echo $donnees_qcm[$d]->section_nom; ?>" href="#" data-id="<?php echo $questions_reponses[$l]->question_id; ?>" class="hover-menu-qst shortcut-qst" style="color: #212529;"><?php echo $l + 1; ?>. <?php echo $questions_reponses[$l]->question_text; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                <?php endfor; ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php for ($all = 0; $all < count($donnees_qcm); $all++) : ?>
                <?php
                $hideSectionByJumper = "d-none";
                if ($donnees_qcm[$all]->section_nom == $section) {
                    $hideSectionByJumper = "";
                }

                ?>
                <div class="col-md-6 p-3 header-jumper-section <?php echo $hideSectionByJumper; ?>" data-section="<?php echo $donnees_qcm[$all]->section_nom; ?>">
                    <?php for ($i = 0; $i < count($donnees_qcm[$all]->questions); $i++) : ?>
                        <?php $questions_reponses = $donnees_qcm[$all]->questions; ?>
                        <?php

                        $toShow = "d-none";
                        if ($i == 0) {
                            $toShow = "";
                        }
                        ?>
                        <div data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" class="card card-questions shadow <?php echo $toShow ?> qst-ID-<?php echo $questions_reponses[$i]->question_id ?>  qst-<?php echo $i + 1 ?>" data-id="qst-<?php echo $i + 1 ?>">
                            <div class="card-header d-flex flex-row p-4" style="justify-content: space-between;background-color: white ;">
                                <h5 class="text-center" style="font-weight: bold ;"><?php echo $donnees_qcm[$all]->section_nom; ?> </h5>
                                <!-- <a href="#" class="text-danger" style="font-size: 20px;"><i class="fa-regular fa-heart heart"></i></a> -->
                            </div>
                            <div class="card-body" style="min-height: 400px;">
                                <div class="card-title">
                                    <p style="font-weight: bold;"><?php echo $i + 1; ?>. <?php echo $questions_reponses[$i]->question_text; ?></p>
                                </div>
                                <ul class="" style="list-style: none ;" data-remarque="0" data-idreponse="0" data-idquestion="<?php echo $questions_reponses[$i]->question_id; ?>">
                                    <?php for ($a = 0; $a < count($questions_reponses[$i]->reponses); $a++) : ?>
                                        <?php $reponse = $questions_reponses[$i]->reponses ?>
                                        <li>
                                            <input disabled class="check-question-results numberOfElement check-question check-question-<?php echo $questions_reponses[$i]->question_id; ?>" type="checkbox" data-question="<?php echo $questions_reponses[$i]->question_id; ?>" data-remarque="<?php echo $reponse[$a]->reponse_remarque; ?>" data-idreponse="<?php echo $reponse[$a]->reponse_id; ?>"> <span class="numberOfElement"><?php echo $reponse[$a]->reponse_contenu ?></span>
                                            <span class="text-success" style="font-weight: bold;"></span>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <p class="text-center p-3">
                                    <span><a data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" href="#" data-id="<?php echo $i ?>" class="btn btn-outline-primary page-prec" style="text-decoration: none ; font-weight: bold;">Question précédente</a></span>
                                    <span style="font-size: 20px; font-weight: bold;margin-left:10px" class="text-danger"><?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?></span>
                                    <span style="font-size: 20px;">/</span>
                                    <span style="font-size: 20px; font-weight: bold;margin-right:10px"><?php echo str_pad(count($donnees_qcm[$all]->questions), 2, "0", STR_PAD_LEFT); ?></span>
                                    <span><a data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" href="#" data-totale="<?php echo count($donnees_qcm[$all]->questions); ?>" data-id="<?php echo $i + 2 ?>" class="btn btn-outline-primary page-suiv" style="text-decoration: none ; font-weight: bold;">Question suivante</a></span>
                                </p>

                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
            <div class="col-md-3 p-3">
                <!-- <div id="app" class="d-flex justify-content-center"></div> -->
                <!-- <div class="d-flex justify-content-center">
                    <div style="width: 150px; height: 150px; border: 10px solid green; border-radius: 50% ; align-items: center ;" class="d-flex justify-content-center">
                        <span id="heure" style="font-size: 20px;">00</span>
                        <span style="font-size: 20px;">:</span>
                        <span id="minute" style="font-size: 20px;">00</span>
                        <span style="font-size: 20px;">:</span>
                        <span id="seconde" style="font-size: 20px;">00</span>
                    </div>
                </div> -->
                <hr>
                <div class="d-flex justify-content-center p-2">
                    <button class="btn btn-outline-danger" id="terminate-revision">Terminer la session</button>
                    <?php echo form_open('AllControllers/enterParametters',['class' => 'd-none']); ?>
                    <button class="d-none" id="btn-terminate">Terminer la session</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
// var_dump($donnees_qcm) ;
$total_qst = 0;
for ($iqcm = 0; $iqcm < count($donnees_qcm); $iqcm++) {
    $total_qst += count($donnees_qcm[$iqcm]->questions);
}

?>


<!-- The Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="modaleResults">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Résultats</h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item py-3">
                        <div class="row">
                            <div class="col-md-10">
                                Nombre de questions répondues
                            </div>
                            <div class="col-md-2">
                                <span id="answered">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-3">
                        <div class="row">
                            <div class="col-md-10">
                                Nombre de questions non répondues
                            </div>
                            <div class="col-md-2">
                                <span id="notAnswered">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-3">

                        <div class="row">
                            <div class="col-md-10">
                                Nombre de réponses justes
                            </div>
                            <div class="col-md-2">
                                <span id="rightAnswer">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item py-3">

                        <div class="row">
                            <div class="col-md-10">
                                Nombre de réponses fausses
                            </div>
                            <div class="col-md-2">
                                <span id="wrongAnswer">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>

                    </li>
                </ul>
                <hr class="isNoteHideShow">
                <ul class="mt-2 list-group isNoteHideShow">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-10">
                                <span style="text-decoration: underline; font-weight: bold ;">Rappel de notation choisie de note/20:</span>
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Bonne réponse
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                                <span id="pointBonne"></span> point(s)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Mauvaise réponse
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                                <span id="pointMauvais"></span> point(s)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Absence de réponse
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                                <span id="pointAbsence"></span> point(s)
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-10">
                                Note /20
                            </div>
                            <div class="col-md-2">
                                <!-- <span id="myNote">0</span><br>   -->
                                <span id="the_note" style="font-size: 20px; font-weight: bold;">0</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" id="showIfEliminatoire">
                        <p class="text-center text-danger" style="font-weight: bold ;">NOTE ELIMINATOIRE</p>
                    </li>
                </ul>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer flex-column">
                <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->

                <!-- <div> -->
                <!-- <button type="button" class="btn btn-outline-primary w-100">Générer code de la session pour partager ou rejouer plus tard</button> -->
                <!-- </div> -->
                <!-- <div> -->
                <!-- <a href="#" class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#modalEvolution" id="getEvolution">Ma progression</a> -->
                <a href="#" class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#modalReponses" id="getResults">Voir les réponses</a>
                <!-- </div> -->
                <!-- <div> -->
                <a href="<?php echo base_url(); ?>" class="btn btn-outline-danger w-100">Quitter</a>
                <!-- </div> -->


            </div>

        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="modalAide">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Aide</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p>Vous pouvez naviguer entre les questions qui suivent ou celles qui précèdent celle affichée sur l’écran principal.</p>
                <p>Vous pouvez également directement naviguer entre les différentes sections (culture administrative et juridique – finances publiques – les institutions européennes – culture numérique) mais aussi les différentes questions que chaque section (dans l’onglet liste des questions).</p>

                <p>Vous pouvez mettre fin à la session en cliquant sur "terminer la session".</p>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalReponses">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <div class="accordion shadow" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Sections
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse show collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul>
                                                    <?php for ($i = 0; $i < count($donnees_qcm); $i++) : ?>
                                                        <li>
                                                            <?php
                                                            $d_none_section = "d-none";
                                                            if (count($donnees_qcm[$i]->questions) > 0) {
                                                                $d_none_section = "";
                                                            }
                                                            ?>

                                                            <a href="#" data-section="<?php echo $donnees_qcm[$i]->section_nom; ?>" class="text-muted section-menu-anchor <?php echo $d_none_section; ?> <?php if ($donnees_qcm[$i]->section_nom == $section) {
                                                                                                                                                                                                                echo 'activated';
                                                                                                                                                                                                            } ?>"><?php echo $donnees_qcm[$i]->section_nom; ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Liste de questions
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php for ($d = 0; $d < count($donnees_qcm); $d++) : ?>
                                                    <?php
                                                    $afficheur = "d-none";

                                                    if ($donnees_qcm[$d]->section_nom == $section) {
                                                        $afficheur = "";
                                                    }
                                                    ?>
                                                    <ul data-section="<?php echo $donnees_qcm[$d]->section_nom; ?>" class="<?php echo $afficheur; ?> qst_list" style="height: 300px; overflow-y: auto;scrollbar-width: thin;-webkit-scrollbar-width: thin; padding-left:0px ;">
                                                        <?php for ($l = 0; $l < count($donnees_qcm[$d]->questions); $l++) : ?>
                                                            <?php $questions_reponses = $donnees_qcm[$d]->questions; ?>
                                                            <li style="font-size: 13px;font-weight:bold ;" class="mt-2">
                                                                <a data-tracer="<?php echo $donnees_qcm[$d]->section_nom; ?>" href="#" data-id="<?php echo $questions_reponses[$l]->question_id; ?>" class="hover-menu-qst shortcut-qst" style="color: #212529;"><?php echo $l + 1; ?>. <?php echo $questions_reponses[$l]->question_text; ?></a>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                <?php endfor; ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php for ($all = 0; $all < count($donnees_qcm); $all++) : ?>
                                <?php
                                $hideSectionByJumper = "d-none";
                                if ($donnees_qcm[$all]->section_nom == $section) {
                                    $hideSectionByJumper = "";
                                }

                                ?>
                                <div class="col-md-9 p-3 header-jumper-section <?php echo $hideSectionByJumper; ?>" data-section="<?php echo $donnees_qcm[$all]->section_nom; ?>">
                                    <?php for ($i = 0; $i < count($donnees_qcm[$all]->questions); $i++) : ?>
                                        <?php $questions_reponses = $donnees_qcm[$all]->questions; ?>
                                        <?php

                                        $toShow = "d-none";
                                        if ($i == 0) {
                                            $toShow = "";
                                        }
                                        ?>
                                        <div data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" class="card card-questions shadow <?php echo $toShow ?> qst-ID-<?php echo $questions_reponses[$i]->question_id ?>  qst-<?php echo $i + 1 ?>" data-id="qst-<?php echo $i + 1 ?>">
                                            <div class="card-header d-flex flex-row p-4" style="justify-content: space-between;background-color: white ;">
                                                <h5 class="text-center" style="font-weight: bold ;"><?php echo $donnees_qcm[$all]->section_nom; ?> </h5>
                                                <!-- <a href="#" class="text-danger" style="font-size: 20px;"><i class="fa-regular fa-heart heart"></i></a> -->
                                            </div>
                                            <div class="card-body" style="min-height: 400px;">
                                                <div class="card-title">
                                                    <p style="font-weight: bold;"><?php echo $i + 1; ?>. <?php echo $questions_reponses[$i]->question_text; ?></p>
                                                </div>
                                                <ul class="" style="list-style: none ;" data-remarque="0" data-idreponse="0" data-idquestion="<?php echo $questions_reponses[$i]->question_id; ?>">
                                                    <?php for ($a = 0; $a < count($questions_reponses[$i]->reponses); $a++) : ?>
                                                        <?php $reponse = $questions_reponses[$i]->reponses ?>
                                                        <li>
                                                            <input disabled class="check-question-results numberOfElement check-question check-question-<?php echo $questions_reponses[$i]->question_id; ?>" type="checkbox" data-question="<?php echo $questions_reponses[$i]->question_id; ?>" data-remarque="<?php echo $reponse[$a]->reponse_remarque; ?>" data-idreponse="<?php echo $reponse[$a]->reponse_id; ?>"> <span class="numberOfElement"><?php echo $reponse[$a]->reponse_contenu ?></span>
                                                            <span class="text-success" style="font-weight: bold;"></span>
                                                        </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                            <div class="card-footer">
                                                <p class="text-center p-3">
                                                    <span><a data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" href="#" data-id="<?php echo $i ?>" class="btn btn-outline-primary page-prec" style="text-decoration: none ; font-weight: bold;">Question précédente</a></span>
                                                    <span style="font-size: 20px; font-weight: bold;margin-left:10px" class="text-danger"><?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?></span>
                                                    <span style="font-size: 20px;">/</span>
                                                    <span style="font-size: 20px; font-weight: bold;margin-right:10px"><?php echo count($donnees_qcm[$all]->questions); ?></span>
                                                    <span><a data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" href="#" data-totale="<?php echo count($donnees_qcm[$all]->questions); ?>" data-id="<?php echo $i + 2 ?>" class="btn btn-outline-primary page-suiv" style="text-decoration: none ; font-weight: bold;">Question suivante</a></span>
                                                </p>

                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="fermerReponses">Fermer</button>
            </div>

        </div>
    </div>
</div>