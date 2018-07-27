<html>
<head>
    <title>Purge the Alien - Battle Engine</title>
    <link rel="stylesheet" type="text/css" href="css\main_style.css">
    <?php include 'util\fileReader.php'; ?>
</head>
<body>
<?php

function calculateP1Points() {
    $total=0;
    for($i=1; $i<8; $i++) {
        $points=ReadData("Data\Player1\Turn{$i}_Points.txt");
        if($points!="-") {
            $total=$total+$points;
        }
    }
    WriteData("Data\Player1\Total_Points.txt",$total);
}

function calculateP2Points() {
    $total=0;
    for($i=1; $i<8; $i++) {
        $points=ReadData("Data\Player2\Turn{$i}_Points.txt");
        if($points!="-") {
            $total=$total+$points;
        }
    }
    WriteData("Data\Player2\Total_Points.txt",$total);
}

function resetPoints() {
    $_SESSION["turn"]=0;
    $_SESSION["p1Army"]="P1 Army";
    $_SESSION["p2Army"]="P2 Army";
    $_SESSION["p1cp"]=0;
    $_SESSION["p2cp"]=0;
    $_SESSION["p1t1"]=0;
    $_SESSION["p1t2"]=0;
    $_SESSION["p1t3"]=0;
    $_SESSION["p1t4"]=0;
    $_SESSION["p1t5"]=0;
    $_SESSION["p1t6"]=0;
    $_SESSION["p1t7"]=0;
    $_SESSION["p2t1"]=0;
    $_SESSION["p2t2"]=0;
    $_SESSION["p2t3"]=0;
    $_SESSION["p2t4"]=0;
    $_SESSION["p2t5"]=0;
    $_SESSION["p2t6"]=0;
    $_SESSION["p2t7"]=0;
}

function addValue($fileName) {
    $value=ReadData($fileName);
    if($value=="-") {
        $value=-1;
    }
    $value++;
    WriteData($fileName,$value);
}

function subtractValue($fileName) {
    $value=ReadData($fileName);
    if($value=="-") {
        $value=-1;
    }
    $value--;
    WriteData($fileName,$value);
}

function createMissionHeader($missionType, $mission) {
	
	writeData("Data\Game\Mission_Header.txt", $missionType . " - " . $mission );
}

function resetTurnFiles() {
    for($t=1; $t<8; $t++) {
        for($p=1; $p<3; $p++) {
            WriteData("Data\Player{$p}\Turn{$t}_Points.txt", "-");
        }
    }
    WriteData("Data\Player1\Total_Points.txt","0");
    WriteData("Data\Player2\Total_Points.txt","0");
}
if (isset($_POST['submitScoreReset'])) {
    resetTurnFiles();
}
if (isset($_POST['initiateEngine'])) {
    writeData("Data\Game\Mission_Type.txt", $_POST["MissionType"]);
	writeData("Data\Game\Mission.txt", $_POST["Mission"]);
    writeData("Data\Game\Points_Limit.txt", $_POST["PointsLimit"]);
    writeData("Data\Game\Deployment.txt", $_POST["Deployment"]);
    writeData("Data\Player1\Name.txt", $_POST["player1Name"]);
    writeData("Data\Player2\Name.txt", $_POST["player2Name"]);
    writeData("Data\Player1\Army.txt", $_POST["player1Army"]);
    writeData("Data\Player2\Army.txt", $_POST["player2Army"]);
    writeData("Data\Player1\Points.txt", $_POST["player1Points"]);
    writeData("Data\Player2\Points.txt", $_POST["player2Points"]);
    writeData("Data\Player1\Power_Level.txt", $_POST["player1PL"]);
    writeData("Data\Player2\Power_Level.txt", $_POST["player2PL"]);
    writeData("Data\Player1\Command_Points.txt", $_POST["player1CP"]);
    writeData("Data\Player2\Command_Points.txt", $_POST["player2CP"]);
	if ($_POST["MissionType"] == "Eternal War") {
		createMissionHeader("EW", $_POST["Mission"]);
	} else {
		createMissionHeader($_POST["MissionType"], $_POST["Mission"]);
	}
	
	
}

if (isset($_POST['submitTurnChange'])) {
    switch($_POST['submitTurnChange']) {
        case '+':
            $turnName='Deployment Review';
            $player1Army=ReadData("data\Player1\Army.txt");
            $player2Army=ReadData("data\Player2\Army.txt");
            $turnNum=intval(ReadData("data\Game\Turn_Number.txt"));
            $armyTurn=ReadData("data\Game\Army_Turn.txt");
            if ($turnNum<17) {
                $turnNum++;
                WriteData("data\Game\Turn_Number.txt",$turnNum);
            }
            switch($turnNum){
				case 0;
					$turnName = 'Pregame';
                    $armyTurn = "Interview";
				break;
				case 1:
                    $turnName = 'Deployment Review';
                    $armyTurn = $player1Army;
                break;
                case 2:
                    $turnName = 'Deployment Review';
                    $armyTurn = $player2Army;
                break;
                case 3:
                    $turnName = 'Turn 1';
                    $armyTurn = $player1Army;
                break;
                case 4:
                    $turnName = 'Turn 1';
                    $armyTurn = $player2Army;
                break;
                case 5:
                    $turnName = 'Turn 2';
                    $armyTurn = $player1Army;
                break;
                case 6:
                    $turnName = 'Turn 2';
                    $armyTurn = $player2Army;
                break;
                case 7:
                    $turnName = 'Turn 3';
                    $armyTurn = $player1Army;
                break;
                case 8:
                    $turnName = 'Turn 3';
                    $armyTurn = $player2Army;
                break;
                case 9:
                    $turnName = 'Turn 4';
                    $armyTurn = $player1Army;
                break;
                case 10:
                    $turnName = 'Turn 4';
                    $armyTurn = $player2Army;
                break;
                case 11:
                    $turnName = 'Turn 5';
                    $armyTurn = $player1Army;
                break;
                case 12:
                    $turnName = 'Turn 5';
                    $armyTurn = $player2Army;
                break;
                case 13:
                    $turnName = 'Turn 6';
                    $armyTurn = $player1Army;
                break;
                case 14:
                    $turnName = 'Turn 6';
                    $armyTurn = $player2Army;
                break;
                case 15:
                    $turnName = 'Turn 7';
                    $armyTurn = $player1Army;
                break;
                case 16:
                    $turnName = 'Turn 7';
                    $armyTurn = $player2Army;
                break;
                case 17:
                    $turnName = "Postgame";
                    $armyTurn = "Interview";
                break;
            }
            WriteData("Data\Game\Turn.txt",$turnName);
            WriteData("Data\Game\Army_Turn.txt",$armyTurn);
        break;
        case '-':
            $turnName='Deployment Review';
            $player1Army=ReadData("data\Player1\Army.txt");
            $player2Army=ReadData("data\Player2\Army.txt");
            $turnNum=intval(ReadData("data\Game\Turn_Number.txt"));
            $armyTurn=ReadData("data\Game\Army_Turn.txt");
            if ($turnNum>0) {
                $turnNum--;
                WriteData("data\Game\Turn_Number.txt",$turnNum);
            }
            switch($turnNum){
                case 0;
					$turnName = 'Pregame';
                    $armyTurn = "Interview";
				break;
				case 1:
                    $turnName = 'Deployment Review';
                    $armyTurn = $player1Army;
                break;
                case 2:
                    $turnName = 'Deployment Review';
                    $armyTurn = $player2Army;
                break;
                case 3:
                    $turnName = 'Turn 1';
                    $armyTurn = $player1Army;
                break;
                case 4:
                    $turnName = 'Turn 1';
                    $armyTurn = $player2Army;
                break;
                case 5:
                    $turnName = 'Turn 2';
                    $armyTurn = $player1Army;
                break;
                case 6:
                    $turnName = 'Turn 2';
                    $armyTurn = $player2Army;
                break;
                case 7:
                    $turnName = 'Turn 3';
                    $armyTurn = $player1Army;
                break;
                case 8:
                    $turnName = 'Turn 3';
                    $armyTurn = $player2Army;
                break;
                case 9:
                    $turnName = 'Turn 4';
                    $armyTurn = $player1Army;
                break;
                case 10:
                    $turnName = 'Turn 4';
                    $armyTurn = $player2Army;
                break;
                case 11:
                    $turnName = 'Turn 5';
                    $armyTurn = $player1Army;
                break;
                case 12:
                    $turnName = 'Turn 5';
                    $armyTurn = $player2Army;
                break;
                case 13:
                    $turnName = 'Turn 6';
                    $armyTurn = $player1Army;
                break;
                case 14:
                    $turnName = 'Turn 6';
                    $armyTurn = $player2Army;
                break;
                case 15:
                    $turnName = 'Turn 7';
                    $armyTurn = $player1Army;
                break;
                case 16:
                    $turnName = 'Turn 7';
                    $armyTurn = $player2Army;
                break;
                case 17:
                    $turnName = "Postgame";
                    $armyTurn = "Interview";
                break;
            }
            WriteData("Data\Game\Turn.txt",$turnName);
            WriteData("Data\Game\Army_Turn.txt",$armyTurn);
        break;
	}
}
if (isset($_POST['submitCPP1'])) {
    switch($_POST['submitCPP1']) {
        case '+':
            addValue("Data\Player1\Command_Points.txt");
        break;
        case '-':
            subtractValue("Data\Player1\Command_Points.txt");
        break;
    }
}
if (isset($_POST['submitCPP2'])) {
    switch($_POST['submitCPP2']) {
        case '+':
            addValue("Data\Player2\Command_Points.txt");
        break;
        case '-':
            subtractValue("Data\Player2\Command_Points.txt");
        break;
    }
}
if (isset($_POST['submitPointsP1'])) {
    $turn = readData("Data\Game\Turn_Number.txt");
    switch($_POST['submitPointsP1']) {
        case '+':
            switch($turn){
                case 0:
                    break;
                case 1:
                    break;
                case 2:
                    break;
                break;
                case 3:
                    addValue("Data\Player1\Turn1_Points.txt");
                break;
                case 4:
                    addValue("Data\Player1\Turn1_Points.txt");
                break;
                case 5:
                    addValue("Data\Player1\Turn2_Points.txt");
                break;
                case 6:
                    addValue("Data\Player1\Turn2_Points.txt");
                break;
                case 7:
                    addValue("Data\Player1\Turn3_Points.txt");
                break;
                case 8:
                    addValue("Data\Player1\Turn3_Points.txt");
                break;
                case 9:
                    addValue("Data\Player1\Turn4_Points.txt");
                break;
                case 10:
                    addValue("Data\Player1\Turn4_Points.txt");
                break;
                case 11:
                    addValue("Data\Player1\Turn5_Points.txt");
                break;
                case 12:
                    addValue("Data\Player1\Turn5_Points.txt");
                break;
                case 13:
                    addValue("Data\Player1\Turn6_Points.txt");
                break;
                case 14:
                    addValue("Data\Player1\Turn6_Points.txt");
                break;
                case 15:
                    addValue("Data\Player1\Turn7_Points.txt");
                break;
                case 16:
					addValue("Data\Player1\Turn7_Points.txt");
                break;
                case 17:
                break;
                }
        break;
        case '-':
            switch($turn){
                case 0:
                break;
                case 1:
                break;
                case 2:
                break;
                case 3:
                    subtractValue("Data\Player1\Turn1_Points.txt");
                break;
                case 4:
                    subtractValue("Data\Player1\Turn1_Points.txt");
                break;
                case 5:
                    subtractValue("Data\Player1\Turn2_Points.txt");
                break;
                case 6:
                    subtractValue("Data\Player1\Turn2_Points.txt");
                break;
                case 7:
                    subtractValue("Data\Player1\Turn3_Points.txt");
                break;
                case 8:
                    subtractValue("Data\Player1\Turn3_Points.txt");
                break;
                case 9:
                    subtractValue("Data\Player1\Turn4_Points.txt");
                break;
                case 10:
                    subtractValue("Data\Player1\Turn4_Points.txt");
                break;
                case 11:
                    subtractValue("Data\Player1\Turn5_Points.txt");
                break;
                case 12:
                    subtractValue("Data\Player1\Turn5_Points.txt");
                break;
                case 13:
                    subtractValue("Data\Player1\Turn6_Points.txt");
                break;
                case 14:
                    subtractValue("Data\Player1\Turn6_Points.txt");
                break;
                case 15:
                    subtractValue("Data\Player1\Turn7_Points.txt");
                break;
                case 16:
					subtractValue("Data\Player1\Turn7_Points.txt");
                break;
                case 17:
                break;
            }      
        break;
	}
        calculateP1Points();
}

if (isset($_POST['submitPointsP2'])) {
    $turn = readData("Data\Game\Turn_Number.txt");
    switch($_POST['submitPointsP2']) {
        case '+':
            switch($turn){
                case 0:
                    break;
                case 1:
                    break;
                case 2:
                break;
                case 3:
                    addValue("Data\Player2\Turn1_Points.txt");
                break;
                case 4:
                    addValue("Data\Player2\Turn1_Points.txt");
                break;
                case 5:
                    addValue("Data\Player2\Turn2_Points.txt");
                break;
                case 6:
                    addValue("Data\Player2\Turn2_Points.txt");
                break;
                case 7:
                    addValue("Data\Player2\Turn3_Points.txt");
                break;
                case 8:
                    addValue("Data\Player2\Turn3_Points.txt");
                break;
                case 9:
                    addValue("Data\Player2\Turn4_Points.txt");
                break;
                case 10:
                    addValue("Data\Player2\Turn4_Points.txt");
                break;
                case 11:
                    addValue("Data\Player2\Turn5_Points.txt");
                break;
                case 12:
                    addValue("Data\Player2\Turn5_Points.txt");
                break;
                case 13:
                    addValue("Data\Player2\Turn6_Points.txt");
                break;
                case 14:
                    addValue("Data\Player2\Turn6_Points.txt");
                break;
                case 15:
                    addValue("Data\Player2\Turn7_Points.txt");
                break;
                case 16:
					addValue("Data\Player2\Turn7_Points.txt");
                break;
                case 17:
                break;
                }
        break;
        case '-':
            switch($turn){
                case 0:
                break;
                case 1:
                break;
                case 2:
                break;
                case 3:
                    subtractValue("Data\Player2\Turn1_Points.txt");
                break;
                case 4:
                    subtractValue("Data\Player2\Turn1_Points.txt");
                break;
                case 5:
                    subtractValue("Data\Player2\Turn2_Points.txt");
                break;
                case 6:
                    subtractValue("Data\Player2\Turn2_Points.txt");
                break;
                case 7:
                    subtractValue("Data\Player2\Turn3_Points.txt");
                break;
                case 8:
                    subtractValue("Data\Player2\Turn3_Points.txt");
                break;
                case 9:
                    subtractValue("Data\Player2\Turn4_Points.txt");
                break;
                case 10:
                    subtractValue("Data\Player2\Turn4_Points.txt");
                break;
                case 11:
                    subtractValue("Data\Player2\Turn5_Points.txt");
                break;
                case 12:
                    subtractValue("Data\Player2\Turn5_Points.txt");
                break;
                case 13:
                    subtractValue("Data\Player2\Turn6_Points.txt");
                break;
                case 14:
                    subtractValue("Data\Player2\Turn6_Points.txt");
                break;
                case 15:
                    subtractValue("Data\Player2\Turn7_Points.txt");
                break;
                case 16:
					subtractValue("Data\Player2\Turn7_Points.txt");
                break;
                case 17:
                break;
            }      
        break;
	}
        calculateP2Points();
}
?>

  <table>
	<tr>
            <td colspan="10" style="text-align: center; background-color:#8e441c; color:white;">
                <b><?php 
                    echo ReadData("Data\Game\Mission_Type.txt"); 
                ?> - <?php 
                    echo ReadData("Data\Game\Mission.txt"); 
                ?></b>
            </td>
            <td colspan="4" style="text-align: center; background-color:#8e441c; color:white;">
                <b><?php 
                    echo ReadData("Data\Game\Points_Limit.txt"); 
                ?></b>
            </td>
	</tr>
	<tr>
            <td colspan="10" style="text-align: center; background-color:#444141; color:white;">
                    <b><?php
                        echo ReadData("Data\Game\Turn.txt");
                    ?> - <?php
                        echo ReadData("Data\Game\Army_Turn.txt");
                    ?></b>
            </td>
            <td colspan="4" style="text-align: center; background-color:#444141; color:white;">
                   <iframe src="http://free.timeanddate.com/clock/i622pia3/n784/fn15/fs20/fcfff/tc444141/ftb/ts1/ta1" frameborder="0" width="139" height="25"></iframe>
            </td>
	</tr>
	<tr class="Player1">
		<td class="Army" rowspan="2" width="75" style="background-color:#8f8a8a;">
                    <p><b><?php
                        echo ReadData("Data\Player1\Army.txt");
                    ?></b></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn1_Points.txt");
                    ?></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn2_Points.txt");
                    ?></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn3_Points.txt");
                    ?></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn4_Points.txt");
                    ?></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn5_Points.txt");
                    ?></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn6_Points.txt");
                    ?></p>
		</td>
		<td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                    <p><?php
                        echo ReadData("Data\Player1\Turn7_Points.txt");
                    ?></p>
		</td>
		<td rowspan="2" style="text-align:center; font-size: 26px; background-color:#8f8a8a;">
                    <p><b><?php
                        echo ReadData("Data\Player1\Total_Points.txt");
                    ?></b></p>
		</td>
		<td rowspan="2" style="text-align:center; font-size: 26px; background-color:#8f8a8a;">
                    <p><b><?php
                        echo ReadData("Data\Player1\Command_Points.txt");
                    ?></b></p>
		</td>
		<td colspan="2" style="text-align:center; background-color:#8e441c; color:white;">
                    <b>Points</b>
                </td>
                <td colspan="2" style="text-align:center; background-color:#8e441c; color:white;">
                    <b>CP</b>
                </td>
	</tr>
        <form name="PointAdd" id="PointAdd" action="battleengine.php" method="post" >
	<tr>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitPointsP1" class="submitPointsP1" name="submitPointsP1" value="+" style="background-color:#669900; font-weight:bold; height: 100%;"/>
            </td>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitPointsP1" class="submitPointsP1" name="submitPointsP1" value="-" style="background-color:#ff4d4d; font-weight:bold; height: 100%;"/>
            </td>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitCPP1" class="submitCPP1" name="submitCPP1" value="+" style="background-color:#669900; font-weight:bold; height: 100%;"/>
            </td>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitCPP1" class="submitCPP1" name="submitCPP1" value="-" style="background-color:#ff4d4d; font-weight:bold; height: 100%;"/>
            </td>
	</tr>
        </form>
	<tr class="Turn">
            <td class="Army" rowspan="2" style="background-color:#444141; color:white;">
                <p><b>TURN</b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>1</b></p>
            </td>
            <td class="Points"  rowspan="2"style="text-align: center; background-color:#444141; color:white;">
                <p><b>2</b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>3</b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>4</b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>5</b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>6</b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>7</b></p>
            </td>
            <td rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>T</b></p>
            </td>
            <td rowspan="2" style="text-align: center; background-color:#444141; color:white;">
                <p><b>CP</b></p>
            </td>
            <td colspan="4" style="text-align:center; background-color:#8e441c; color:white;">
                <b>Turn</b>
            </td>
	</tr>
        <tr>
            <form name="submitTurnChange" id="submitTurnChange" action="battleengine.php" method="post" >
            <td colspan="2" style="text-align:center; background-color:#444141;"">
               <input type="submit" id="submitTurnAdd" class="submitTurnAdd" name="submitTurnChange" value="+" style="background-color:#669900; font-weight:bold; height: 100%;"/>
            </td>
            <td colspan="2" style="text-align:center; background-color:#444141;">
               <input type="submit" id="submitTurnAdd" class="submitTurnAdd" name="submitTurnChange" value="-" style="background-color:#ff4d4d; font-weight:bold; height: 100%"/>
            </td>
            </form>
	</tr>
	<tr class="Player2">
            <td class="Army" rowspan="2" width="55" style="background-color:#8f8a8a;">
                <p><b><?php
                    echo ReadData("Data\Player2\Army.txt");
                ?></b></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn1_Points.txt");
                ?></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn2_Points.txt");
                ?></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn3_Points.txt");
                ?></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn4_Points.txt");
                ?></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn5_Points.txt");
                ?></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn6_Points.txt");
                ?></p>
            </td>
            <td class="Points" rowspan="2" style="text-align:center; background-color:#8f8a8a;">
                <p><?php
                    echo ReadData("Data\Player2\Turn7_Points.txt");
                ?></p>
            </td>
            <td rowspan="2" style="text-align:center; background-color:#8f8a8a; font-size: 26px;">
                <p><b><?php
                    echo ReadData("Data\Player2\Total_Points.txt");
                ?></b></p>
            </td>
            <td rowspan="2" style="text-align:center; background-color:#8f8a8a; font-size: 26px;">
                <p><b><?php
                    echo ReadData("Data\Player2\Command_Points.txt");
                ?></b></p>
            </td>
            <td colspan="2" style="text-align:center; background-color:#8e441c; color:white;">
                    <b>Points</b>
            </td>
            <td colspan="2" style="text-align:center; background-color:#8e441c; color:white;">
                    <b>CP</b>
            </td>
	</tr>
        <form name="PointAdd" id="PointAdd" action="battleengine.php" method="post" >
	<tr>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitPointsP2" class="submitPointsP2" name="submitPointsP2" value="+" style="background-color:#669900; font-weight:bold; height: 100%;"/>
            </td>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitPointsP2" class="submitPointsP2" name="submitPointsP2" value="-" style="background-color:#ff4d4d; font-weight:bold; height: 100%;"/>
            </td>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitCPP2" class="submitCPP2" name="submitCPP2" value="+" style="background-color:#669900; font-weight:bold; height: 100%;"/>
            </td>
            <td style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitCPP2" class="submitCPP2" name="submitCPP2" value="-" style="background-color:#ff4d4d; font-weight:bold; height: 100%;"/>
            </td>
	</tr>
        </form>
        <form name="indexBack" id="indexBack" action="index.php" method="get" >
	<tr style="text-align:left;">
            <td colspan="10" style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitIndexBack" class="submitIndexBack" name="submitIndexBack" value="<< Back to Game Input" style="background-color=gray;"/>
            </td>
        </form>
        <form name="resetScore" id="resetScore" action="BattleEngine.php" method="post" >
            <td colspan="4" style="text-align:center; background-color:#444141;">
                <input type="submit" id="submitScoreReset" class="submitScoreReset" name="submitScoreReset" value="Reset Score" style="background-color=gray;" onclick="return confirm('Are you sure you want to reset the score?');"/>
            </td>
        </form>
	</tr>
  </table>
</body>
</html>