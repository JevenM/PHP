
<?php
		
    		$con=mysqli_connect('localhost','root','1234','myblog');
		mysqli_query($con,"set names utf8");
		if(mysqli_connect_error()){
			 die('删除数据库失败: ' . mysqli_error($con));
		}else{
			echo "<h2>successd connect to database！</h2>";
			echo "<br />";
			// mysqli_select_db($con,'myblog');
			$sql = "select * from wenzhang";
			$result = $con->query($sql);
			while($row = $result->fetch_array())
			// while($row = mysqli_fetch_array($result))
			{
				echo "id    ==>";
				echo $row[0];
				echo "<br />";

				echo "题目    ==>";
				echo $row[1];
				echo "<br />";

				echo "作者    ==>";
				echo $row[2];
				echo "<br />";

				echo "内容    ==>";
				echo $row[3];
				echo "<br />";

				echo "日期    ==>";
				echo $row[4];
				echo "<br />";
			}
			mysqli_close($con);
		}

 ?>


 