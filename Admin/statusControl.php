<?php 
	$conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");

	$sql = "SELECT * FROM rotausersduty";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($datarows = $result->fetch_assoc()) {
			$meetingDate = $datarows["dutyDate"];
			$morningStartTime = $datarows["morningStartTime"];
			$morningEndTime = $datarows["morningEndTime"];
			$afternoonStartTime = $datarows["afternoonStartTime"];
			$afternoonEndTime = $datarows["afternoonEndTime"];
			$ID = $datarows["ID"];

			//Date Today in seconds
			date_default_timezone_set("Africa/Nairobi");
			$currentTimeSec = time();

			//Morning Start time in seconds
			$morningStart = $meetingDate." ". $morningStartTime;
			$morningStartTimeSec = strtotime($morningStart);
			$morningStartTimeSec;

			//Morning end time in seconds
			$morningEnd = $meetingDate." ". $morningEndTime;
			$morningEndTimeSec = strtotime($morningEnd);
			$morningEndTimeSec;

			//Afternoon start time in seconds
			$afternoonStart = $meetingDate." ". $afternoonStartTime;
			$afternoonStartTimeSec = strtotime($afternoonStart);
			$afternoonStartTimeSec;

			//Afternoon end time in seconds
			$afternoonEnd = $meetingDate." ". $afternoonEndTime;
			$afternoonEndTimeSec = strtotime($afternoonEnd);
			$afternoonEndTimeSec;

			$currentTimeSec > $morningStartTimeSec;

			if($currentTimeSec > $morningStartTimeSec){
				$sql = "UPDATE rotausersduty SET morningStatus = 'active' WHERE ID='$ID' ";
				$conn->query($sql);
			}
			if($currentTimeSec > $morningEndTimeSec){
				$sql = "UPDATE rotausersduty SET morningStatus = 'ended' WHERE ID='$ID' ";
				$conn->query($sql);
			}
			if($currentTimeSec > $afternoonStartTimeSec){
				$sql = "UPDATE rotausersduty SET afternoonStatus = 'active' WHERE ID='$ID' ";
				$conn->query($sql);
			}
			if($currentTimeSec > $afternoonEndTimeSec){
				$sql = "UPDATE rotausersduty SET afternoonStatus = 'ended' WHERE ID='$ID' ";
				$conn->query($sql);
			}
		}
	}

	

 ?>