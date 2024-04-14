<?php
// Entry Viewer - Standard Version v2.01.2

wp_enqueue_script("jquery");

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}


function sport_systems_standard($atts = array(), $content = null, $tag){

$atts = shortcode_atts(array( 'meet' => null, 'mileage' => null), $atts);

$selectedmeet = $atts['meet'];

$sport_systems_options = get_option( 'sport_systems_option_name' ); // Array of All Options

$accepted_entries_file_0 = $sport_systems_options['accepted_entries_file_0']; // Accepted Entries File;
if($selectedmeet == "0"){
	$accepted_entries_file_0 = $sport_systems_options['accepted_entries_file_0']; // Accepted Entries File;
}
if($selectedmeet == "1"){
	$accepted_entries_file_0 = $sport_systems_options['accepted_entries_file_1']; // Accepted Entries File;
}
if($selectedmeet == "2"){
	$accepted_entries_file_0 = $sport_systems_options['accepted_entries_file_2']; // Accepted Entries File;
}
if($selectedmeet == "3"){
	$accepted_entries_file_0 = $sport_systems_options['accepted_entries_file_3']; // Accepted Entries File;
}

//$show_withdrawels_1 = $sport_systems_options['show_withdrawels_1']; // Show Withdrawels
$withdrawals_form_url_2 = $sport_systems_options['withdrawals_form_url_2']; // Withdrawals form URL
$entries_header = $sport_systems_options['entries_header']; // Header Text
$entries_text = $sport_systems_options['entries_text']; // Entry Information
$entries_headereventno = $sport_systems_options['entries_headereventno']; // Entry Information
$entries_headereventname = $sport_systems_options['entries_headereventname']; // Entry Information
$entries_headereventcompno = $sport_systems_options['entries_headereventcompno']; // Entry Information
$entries_headerevententrytime = $sport_systems_options['entries_headerevententrytime']; // Entry Information
$entries_headereventsession = $sport_systems_options['entries_headereventsession']; // Entry Information
$hide_yob = $sport_systems_options['hide_yob']; // Hide YOB
$hide_disability = $sport_systems_options['hide_disability']; // Hide Disability Codes
$entries_emailaddress = $sport_systems_options['entries_emailaddress']; // Email Address
$entries_emailname = $sport_systems_options['entries_emailname']; // Email Nsme or Text

//$meet = get_option('meet');

//echo $meet(0);


$sportsystems_myfile = fopen($accepted_entries_file_0, "r");
$currentmeetname = fgets($sportsystems_myfile) ;
fclose($sportsystems_myfile);


//extract( shortcode_atts( array('meet'=&gt; 1,), $atts ) );

ob_start();





?>
        
<style>

html,
body {
    height: 100%;
    width: 100%;
    margin: 0;
    overflow: auto;
}

html {
    box-sizing: border-box;
    font-size: 100%;
    font-family: sans-serif;
    line-height: 1.15;
}

*,
::after,
::before {
    -webkit-box-sizing: inherit;
    box-sizing: inherit;
}

body > h1 {
    text-align: center;
}

.container {
    width: 100%;
    padding-bottom: 2.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.container > p {
	margin: 0 0 1rem 0;
    line-height: 1.5;
    text-align: center;
}

.container > h2,
.container > h3 {
	margin: 0 0 1.25rem 0;
    text-align: center;
}

.table-group > div {
    width: 100%;
}

.table-group > div > div {
    overflow-x: auto;
}

.table-group h3 {
    margin-top: 2.5rem;
    margin-bottom: 0.1rem;
}

.table-group h5 {
    margin-top: 0;
}

.table-group table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
}

.table-group th, .table-group td {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border: 1px solid #ddd;
    padding: 0.5rem;
}

.table-group thead td {
    text-align: center;
    font-weight: bold;
}

.table-group tbody > tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table-group tbody td:nth-child(1),
.table-group tbody td:nth-child(3),
.table-group tbody td:nth-child(5) {
    text-align: center;
}

.table-group tbody td:nth-child(4) {
    text-align: right;
}

.table-group td:nth-child(2) {
    width: 40%;
}

.table-group td:nth-child(5) {
    width: 17.5%;
}

#select-container {
    display: flex;
    justify-content: center;
    position: -webkit-sticky; /* Safari */
    position: sticky;
    top: 0;
    padding: 1rem;
    width: 100%;
    background-color: #fff;
    border-bottom: 1px solid #aaa;
    z-index: 100;
}

#select-container > .input-line {
    margin-right: 1rem;
}

#select-container > .input-line:last-child {
    margin-right: 0;
}

#select-container > .input-line select {
    padding: 0.5rem;
    width: 100%;
}

/* Screens <= 768px */
@media only screen and (max-width: 48em) {

    html {
        font-size: 75%;
    }

    .container > * {
        max-width: 100%;
    }

    .container > p {
        max-width: 80%;
    }

    .table-group {
        width: 95%;
    }

    .table-group table {
        table-layout: auto;
    }

    #select-container > .input-line {
        width: 40%;
    }

}

/* Screens >= 768 and <= 992 */
@media only screen and (min-width: 48em) and (max-width: 62em) {

    html {
        font-size: 100%;
    }

    .container > * {
        max-width: 90%;
    }

    .container > p {
        max-width: 70%;
    }

    .table-group {
        width: 85%;
    }

    .table-group table {
        font-size: 0.75rem;
        table-layout: fixed;
    }

    #select-container > .input-line {
        width: 35%;
    }

}

/* Screens >= 992 */
@media only screen and (min-width: 62em) {

    .container > * {
        max-width: 80%;
    }

    .container > p {
        max-width: 60%;
    }

    .table-group {
        width: 75%;
    }

    .table-group table {
        font-size: 1rem;
        table-layout: fixed;
    }

    #select-container > .input-line {
        width: 33%;
		font-size: 85%;
    }

}


</style>
        <!-- External -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

        <!-- EDIT VARIABLE HERE TO CHANGE FILE TO LOAD -->
        <script>
            const textfile = '<?php echo esc_attr($accepted_entries_file_0); ?>';
        </script>
<center>
        <h1 class="main-header"><?php echo esc_attr($entries_header); ?></h1>
<hr>
        <div id="message-container" class="container" style="display: none;">
            <h3 class="message">Unable to load latest entries, please try again later.</h3>
        </div>

        <div id="entry-container" class="container" style="visibility: hidden;">
            <h2 id="meet-name" class="entry-header"></h2>

            <p id="modified-date" class="date-display"></p>

            <p class="description"><?php echo esc_attr($entries_text); ?></p>
            <p class="description"><a href="mailto:<?php echo esc_attr($entries_emailaddress); ?>?subject=<?php echo esc_attr($currentmeetname); ?>"><?php echo esc_attr($entries_emailname); ?></a></br>

<hr>
            <p class="description">Use the selection boxes to view the latest entries for your swimmer or club.</p>

            <div id="select-container">
                <div class="input-line">
                    <select id="swimmer-dropdown" name="swimmer">
                        <option value="">Select swimmer..</option>
                    </select>
                </div>
                <div class="input-line">
                    <select id="club-dropdown" name="club">
                        <option value="">Select club..</option>
                    </select>
                </div>
            </div>

            <div id="table-container" class="table-group">
            </div>
        </div>

        <!-- Internal Scripts -->
        <script type="text/javascript">



// Loading entries file to browse
const meet = {
    meetName: '',
    fileDate: new Date(),
    clubs: [],
    ready: false
};

// This is done immediately when the file is loaded by html
// We expect the text file to always be there
$.ajax({
    url: textfile,
    cache: false
})
.done(ent => sportsystems_parseEntries(ent))
.fail(() => {
    // Failed to load text file, display message to come back later
    $('#message-container').css('display', 'flex');
})
.always(() => {
    $(document).ready(() => {
        if (meet.ready){
            sportsystems_loadmeet();
        } else {
			// Unable to load meet, assume error state
			$('#message-container').css('display', 'flex');
		}
    });
});

function sportsystems_parseEntries(entries) {

    const lines = entries.split(/\r?\n/);
    const lineCount = lines.length;
    let clubIndex = -1;
    let swimmerIndex = -1;
	let clubPattern = /[a-z]/i;

    meet.meetName = lines[0];
    meet.fileDate = new Date(lines[1].split('-')[1].trim());

    for (let i = 2; i < lineCount; i++) {
        let line = lines[i];

        if (line.trim() === '') {

			let nextLine = lines[++i] || '';

            let club = {
                name: nextLine,
                swimmers: []
            }

            if (clubPattern.test(club.name)) {
				meet.clubs.push(club);
                clubIndex++;
                swimmerIndex = -1;
            } else {
				// End of file
				meet.ready = true;
                break;
            }

        } else {

            let club = meet.clubs[clubIndex];
            let cols = line.split('\t');

            if (cols.length < 6) {

                // Swimmer line
                let swimmer = sportsystems_formatSwimmer({
                    name: cols[0],
                    birthYear: cols[1],
                    env: cols[2],
                    categories: cols[3] || '',
                    events: []
                });

                club.swimmers.push(swimmer);

                swimmerIndex++;

            } else {

                // Event line
                let evt = sportsystems_formatEvent({
                    number: cols[0],
                    name: cols[1],
                    comp: cols[2],
                    time: cols[3],
                    session: cols[4],
                    startTime: cols[5]
                });

                club.swimmers[swimmerIndex].events.push(evt);

            }
        }
    }

}

function sportsystems_loadmeet() {

    // Header name
    $('#meet-name').html(meet.meetName);

    $('#modified-date').html(`Last updated ${meet.fileDate.toLocaleString()}`);

    const swimbox = $('#swimmer-dropdown');
    const clubbox = $('#club-dropdown');

    meet.clubs.forEach((club, clubIndex) => {

        club.swimmers.forEach((swimmer, swimmerIndex) => {

            let value = `${clubIndex}%${swimmerIndex}`;
            let text = `${club.name} - ${swimmer.name}`;

            // Swimmer options
            swimbox.append($('<option />').val(value).text(text));

        });

        // Club options
        clubbox.append($('<option />').val(clubIndex).text(club.name));

    });

    // Register events
    swimbox.on('change', () => {
        clubbox.val('');

        let indexes = swimbox.val().split('%');

        sportsystems_loadTable(parseInt(indexes[0], 10), parseInt(indexes[1], 10));
    });

    clubbox.on('change', () => {
        swimbox.val('');

        sportsystems_loadTable(parseInt(clubbox.val(), 10));
    });

    $('#entry-container').css('visibility', 'visible');

}

function sportsystems_loadTable(clubIndex, swimmerIndex = -1) {

    const club = meet.clubs[clubIndex];
    let swimmers = [];

    // Here we generate the table
    if (swimmerIndex < 0) {
        // Load entire club
        swimmers = club.swimmers;
    } else {
        swimmers.push(club.swimmers[swimmerIndex]);
    }

    $('#table-container').empty();

    swimmers.forEach((swimmer, index) => {

        $('#table-container')
        .append(
            $('<div>').append(
                `<h3>${swimmer.name}, ${club.name}</h3>
                <h5>

<?php

if (strpos($hide_yob, 'hide') !== false) {
    echo '' ;
} else {
 ?>${swimmer.birthYear}<?php  ;
}

if (strpos($hide_disability, 'hide') !== false) {
    echo '' ;
} else {
 ?>${swimmer.categories}<?php  ;
}



?>






</h5>`
            )
            .append(
                $('<div>').append(
                    $('<table>').append(
                        $('<thead>').append(
                           `<tr>
                                <td><?php echo esc_attr($entries_headereventno); ?></td>
                                <td><?php echo esc_attr($entries_headereventname); ?></td>
                                <td><?php echo esc_attr($entries_headereventcompno); ?></td>
                                <td><?php echo esc_attr($entries_headerevententrytime); ?></td>
                                <td><?php echo esc_attr($entries_headereventsession); ?></td>
                            </tr>`
                        )
                    ).append($('<tbody>'))
                    .prop('id', `t${index}`)
                )
            )
        )

        swimmer.events.forEach(evt => {

            $(`#t${index} > tbody:last-child`).append(
                `<tr>
                    <td>${evt.number}</td>
                    <td>${evt.name}</td>
                    <td>${evt.comp}</td>
                    <td>${evt.time}</td>
                    <td>${evt.session}</td>
                </tr>`
            )

        });

    });

}

function sportsystems_formatSwimmer(swimmer) {

	swimmer.birthYear = `YoB: '${swimmer.birthYear}`;



 
    if (swimmer.categories) {
        let cats = swimmer.categories.split('-')[1].trim();

        cats = cats.replace(/,(?=[^\s])/g, ", ");

        swimmer.categories = `, Categories: ${cats}`;
    }

    return swimmer;
}

function sportsystems_formatEvent(evt) {

    evt.number = evt.number.split(/\s/)[1];
    evt.comp = evt.comp.split(/\s/)[1];
    let session = evt.session.split(/\s/)[1];
    let startDate = evt.startTime.split('-')[0];

    evt.session = `${session} ${startDate.trim()})`;

    return evt;
}





</script>


<left>
<a href="http://www.swimtools.uk" target="_blank"><img src="<?php echo plugin_dir_url( 'sportsystems-entry' ) ; ?>sportsystems-entry/img/Powered_By_SwimTools.png" width="100"></a>

<?php
// We ask that you do not remove the 'PoweredBy SwimTools' Logo and Link to allow the wider awareness of the plugin and to help other clubs in the swim community.




return ob_get_clean();

}

add_shortcode('sport-systems-viewer', 'sport_systems_standard');

?>