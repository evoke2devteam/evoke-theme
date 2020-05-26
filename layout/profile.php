<?php 

  defined('MOODLE_INTERNAL') || die;

    // Include header.
    require_once(dirname(__FILE__) . '/includes/header.php');

    // If page is Grader report don't show side post.
if (($PAGE->pagetype == "grade-report-grader-index") ||
($PAGE->bodyid == "page-grade-report-grader-index")) {
$left = true;
$hassidepost = false;
} else {
$left = $PAGE->theme->settings->blockside;
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
}
$regions = theme_adaptable_grid($left, $hassidepost);
?>

<div class="container outercont">
<?php
    //echo $OUTPUT->page_navbar(false);
?>
<div id="page-content" class="row<?php echo $regions['direction'];?>">
    <section id="region-main" class="<?php echo $regions['content'];?>">
        <?php
            echo $OUTPUT->get_course_alerts();
            echo $OUTPUT->course_content_header();
        ?> 
        
        <div> 
            <?php echo $OUTPUT->main_content(); ?> 

             <?php 
                global $DB;
                $contCreativeVisionary = 0; // 94
                $contProblemSolver = 0; // 95
                $contDeepCollaborator = 0; // 96
                $contEmpatheticChangemaker = 0; //97

                $labelsSuperpowers = array();

                $queryCreativeVisionary = $DB->get_records('competency', array('competencyframeworkid' => 16, 'id' => 94), '', '*', 0, 1);
                foreach ($queryCreativeVisionary as $element) {
                    array_push($labelsSuperpowers, $element->shortname);
                }
                
                $queryProblemSolver = $DB->get_records('competency', array('competencyframeworkid' => 16, 'id' => 95), '', '*', 0, 0);;
                foreach ($queryProblemSolver as $element) {
                    array_push($labelsSuperpowers, $element->shortname);
                }

                $queryDeepCollaborator = $DB->get_records('competency', array('competencyframeworkid' => 16, 'id' => 96), '', '*', 0, 0);;
                foreach ($queryDeepCollaborator as $element) {
                    array_push($labelsSuperpowers, $element->shortname);
                }

                $queryEmpatheticChangemaker = $DB->get_records('competency', array('competencyframeworkid' => 16, 'id' => 97), '', '*', 0, 0);;
                foreach ($queryEmpatheticChangemaker as $element) {
                    array_push($labelsSuperpowers, $element->shortname);
                }

                $userCompetencies = $DB->get_records('competency_usercomp', array('userid' => $USER->id), '', '*', 0, 0);
                $competencies = $DB->get_records('competency', array('competencyframeworkid' => 16), '', '*', 0, 0);
                foreach($userCompetencies as $userCompetency){
                    
                    foreach($competencies as $competency){
                        $parents = array_slice(explode('/', $competency->path), 2, -1);
                        if($competency->id == $userCompetency->competencyid){
                            if(in_array(94, $parents)){
                                $contCreativeVisionary+=$userCompetency->grade;
                            }else if(in_array(95, $parents)){
                                $contProblemSolver+=$userCompetency->grade;
                            }else if(in_array(96, $parents)){
                                $contDeepCollaborator+=$userCompetency->grade;
                            }else if(in_array(97, $parents)){
                                $contEmpatheticChangemaker+=$userCompetency->grade;
                            }
                        }
                    }
                    
                }
            ?>
        </div>

        <!-- Start profile -->

            <!--<div class="containerProfile">

           

                <div id="userProfileImage">
                    <?php //echo $OUTPUT->user_picture($USER, array('size'=>100)); ?>
                </div>

                <div id="generalInformation">
                    <img class="iconLabel" src="<?php echo $OUTPUT->image_url('info', 'theme'); ?>">
                    <h3>Habilidades</h3>
                    <div class="name">
                        <img class="iconLabel" src="<?php echo $OUTPUT->image_url('user_icon', 'theme'); ?>">  
                        <span class="field">Nombre: </span>
                        <span class="valueField"> <?php echo $USER->firstname . ' ' . $USER->lastname; ?> </span>
                    </div>
                    <div class="evocoins">
                        <img class="iconLabel" src="<?php echo $OUTPUT->image_url('evocoins', 'theme'); ?>">
                        <span class="field">Evocoins: </span>
                        <span class="valueField">
                            <?php
                                /*$url = 'http://172.17.0.4:3001/user/balance?id=' . $USER->id;
                                //  Initiate curl
                                $ch = curl_init();
                                // Will return the response, if false it print the response
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                // Set the url
                                curl_setopt($ch, CURLOPT_URL,$url);
                                // Execute
                                $result=curl_exec($ch);
                                // Closing
                                curl_close($ch);
                                $obj = json_decode($result, true);
                                echo $obj['coins'];
                                // Will dump a beauty json :3
                                var_dump();*/
                            ?>
                        </span>
                    </div>
                    <div class="campaign">
                        <img class="iconLabel" src="<?php echo $OUTPUT->image_url('campaign', 'theme'); ?>">
                        <span class="field">Campaña actual: </span>
                        <span class="valueField"> Jugar loop</span>
                    </div>
                    <div class="institution">
                        <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                        <span class="field">Institución: </span>
                        <span class="valueField"> Universidad EAN</span>
                    </div>
                    <div id="containerChart">
                        <canvas id="chart"></canvas>
                    </div>
                    
                </div>

                <div id="powers">
                    <div class="title">
                        <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                        <h3>Tus poderes</h3>
                    </div>
                    <div class="description">
                        <span>A continuación, podrás revisar tu progresos en cada uno de los poderes y súper poderes</span>
                    </div>
                    <div class="superpower">
                        <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                        <div>
                            <h5>Superpoder a</h5>
                            <div class="progressBar"></div>
                        </div>
                        <div class="power one">
                            <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                            <div>
                                <h6>Poder a</h6>
                                <div class="progressBar"></div>
                            </div>
                        </div>
                        <div class="power two">
                            <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                            <div>
                                <h6>Poder b</h6>
                                <div class="progressBar"></div>
                            </div>
                        </div>
                        <div class="power three">
                            <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                            <div>
                                <h6>Poder c</h6>
                                <div class="progressBar"></div>
                            </div>
                        </div>
                        <div class="power four">
                            <img class="iconLabel" src="<?php echo $OUTPUT->image_url('institution', 'theme'); ?>">
                            <div>
                                <h6>Poder d</h6>
                                <div class="progressBar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> -->

            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
            <script>
                let ctx = document.getElementById('chart').getContext('2d');
                let data = {
                    labels: [
                        '<?php echo $labelsSuperpowers[1]; ?>', 
                        '<?php echo $labelsSuperpowers[0]; ?>',
                        '<?php echo $labelsSuperpowers[2]; ?>', 
                        '<?php echo $labelsSuperpowers[3]; ?>'
                    ],
                    datasets: [{
                        data: [
                            <?php echo $contProblemSolver; ?>, 
                            <?php echo $contCreativeVisionary; ?>,
                            <?php echo $contDeepCollaborator; ?>, 
                            <?php echo $contEmpatheticChangemaker; ?>
                        ],
                        backgroundColor: "rgba(200, 200, 200, 0.2)",
                        borderColor: 'rgb(234,136,14)',
                        pointBackgroundColor: 'rgb(255,240,0)',
                        fill: false
                    }]
                };
                let options = {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            color: "white"
                        }
                    },
                    legend: {
                        display: false,
                    },
                    scale: {
                        angleLines: {
                            color: 'rgba(255, 255, 255, 0.4)'
                        },
                        line:{
                            backgroundColor: 'rgba(255, 255, 255, 0.4)'
                        },
                        ticks: {
                            suggestedMax: 0,
                        },
                        gridLines: {
                            color: ['rgba(255, 255, 255, 0.4)']
                        },
                        pointLabels:{
                            fontColor:"white",
                            fontSize: 11
                        }
                    }
                };
                let myRadarChart = new Chart(ctx, {
                    type: 'radar',
                    data: data,
                    options: options
                });
            </script>


         <!-- End profile -->

        <?php
        if ($PAGE->has_set_url()) {
            $currenturl = $PAGE->url;
        } else {
            $currenturl = $_SERVER["REQUEST_URI"];
        }

        // Display course page block activity bottom region if this is a mod page of type where you're viewing
        // a section, page or book (chapter).
        if (!empty($PAGE->theme->settings->coursepageblockactivitybottomenabled)) {
            if ( stristr ($currenturl, "mod/page/view") ||
                 stristr ($currenturl, "mod/book/view") ) {
                echo $OUTPUT->get_block_regions('customrowsetting', 'course-section-', '12-0-0-0');
            }
        }

        echo $OUTPUT->activity_navigation();
        echo $OUTPUT->course_content_footer();
        ?>
    </section>

    <?php
    if ($hassidepost) {
        echo $OUTPUT->blocks('side-post', $regions['blocks'].' d-print-none ');
    }
    ?>
</div>
</div>

<?php 
// Include footer.
require_once(dirname(__FILE__) . '/includes/footer.php');
?>