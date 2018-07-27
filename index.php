<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Purge the Alien - Battle Engine</title>
    <link rel="stylesheet" type="text/css" href="css\main_style.css">
    <?php include 'util\fileReader.php'; ?>
</head>
<body>
<form name="InitiateEngine" id="InitiateEngine" action="battleengine.php" method="post" >
<table>
    <tr>
        <td colspan="4" style="text-align: center; background-color:#8e441c; color:white; font-size:2.5vw;"><b>Game Info</b></td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Platform:</b></td>
        <td><select name="platform">
            <option value="Warhammer40k">Warhammer 40k</option>
            <option value="WarhammerAoS">Warhammer AoS</option>
        </select></td>
        <td style="background-color:#444141; color: white;"><b>Mission Type:</b></td>
        <td><input type="text" name="MissionType" value="<?php echo readData("Data\Game\Mission_Type.txt");?>"</td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Play Type:</b></td>
        <td><select name="playType">
            <option value="MatchedPlay">Matched Play</option>
            <option value="NarrativePlay">Narrative Play</option>
            <option value="OpenPlay">Open Play</option>
        </select></td>
        <td style="background-color:#444141; color: white;"><b>Mission:</b></td>
        <td><input type="text" name="Mission" value="<?php echo readData("Data\Game\Mission.txt");?>"></td>
    </tr>
    </tr>
        <tr>
        <td style="background-color:#444141; color: white;"><b>Points/PL Limit:</b></td>
        <td><input type="text" name="PointsLimit" value="<?php echo readData("Data\Game\Points_Limit.txt");?>"></td>
        <td style="background-color:#444141; color: white;"><b>Deployment:</b></td>
        <td><input type="text" name="Deployment" value="<?php echo readData("Data\Game\Deployment.txt");?>"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; background-color:#8e441c; color:white; font-size:2.5vw;"><b>Player 1</b></td>
        <td colspan="2" style="text-align: center; background-color:#8e441c; color:white; font-size:2.5vw;"><b>Player 2</b></td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Name:</b></td>
        <td><input type="text" name="player1Name" value="<?php echo readData("Data\Player1\Name.txt");?>"></td>
        <td style="background-color:#444141; color: white;"><b>Name:</b></td>
        <td><input type="text" name="player2Name" value="<?php echo readData("Data\Player2\Name.txt");?>"></td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Army:</b></td>
        <td><input type="text" name="player1Army" value="<?php echo readData("Data\Player1\Army.txt");?>"></td>
        <td style="background-color:#444141; color: white;"><b>Army:</b></td>
        <td><input type="text" name="player2Army" value="<?php echo readData("Data\Player2\Army.txt");?>"></td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Points:</b></td>
        <td><input type="text" name="player1Points" value="<?php echo readData("Data\Player1\Points.txt");?>"></td>
        <td style="background-color:#444141; color: white;"><b>Points:</b></td>
        <td><input type="text" name="player2Points" value="<?php echo readData("Data\Player2\Points.txt");?>"></td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Power Level:</b></td>
        <td><input type="text" name="player1PL" value="<?php echo readData("Data\Player1\Power_Level.txt");?>"></td>
        <td style="background-color:#444141; color: white;"><b>Power Level:</b></td>
        <td><input type="text" name="player2PL" value="<?php echo readData("Data\Player2\Power_Level.txt");?>"></td>
    </tr>
    <tr>
        <td style="background-color:#444141; color: white;"><b>Command Points:</b></td>
        <td><input type="text" name="player1CP" value="<?php echo readData("Data\Player1\Command_Points.txt");?>"></td>
        <td style="background-color:#444141; color: white;"><b>Command Points:</b></td>
        <td><input type="text" name="player2CP" value="<?php echo readData("Data\Player2\Command_Points.txt");?>"></td>
    </tr>
    <tr>
        <td style="background-color:#444141;" colspan="2"><input type="submit" id="initiateEngine" class="initiateEngine" name="initiateEngine" value="Submit"/></form></td>
        <td style="background-color:#444141;" colspan="1"><input type="submit" id="resetEngine" class="resetEngine" name="resetEngine" value="Reset" onclick="return confirm('Are you sure you want to reset the Battle Engine?');"/></td>
		<form name="InitiateEngine" id="InitiateEngine" action="index.php" method="post" >
		<td style="background-color:#444141;" colspan="1"><input type="submit" id="reloadPage" class="reloadPage" name="reloadPage" value="Reload Data" onclick="window.location.reload(true);"/></td>
    </tr>
</table>
</body>
</html>