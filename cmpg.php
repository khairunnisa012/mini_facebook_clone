<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'fb';
$conn = mysqli_connect($host, $username, $password, $dbname);
$url=$_SESSION['addr'];
$u
?>
<div class='type'>
            <form action="incm.php" method="post">
                <input type="type" class="inp" name="msg" placeholder="Comment Here...">
                <input type="submit" name="submit" class="button2">
            </form>
</div>
    <?php
    $res = mysqli_query($conn,"select * from uploads where path='$url'");
    $i = mysqli_fetch_assoc($res);
    $like=$i['likes'];
    $user=$i['id'];
    echo "<div class='post'>";
    echo "<img src='{$url}' height='400px' width='300px'>";
    echo "<br><label for='u'>Name:{$user}</label>";
    echo "<br><label for='u'>Likes:{$like}</label>";
    echo "</div>";
    $res = mysqli_query($conn,"select * from msg where url='$url' order by date");
        if (mysqli_num_rows($res) > 0) {
            while ($i = mysqli_fetch_assoc($res)) {?>
            <div class="ms">
            <?php echo "<br><label class='sender'>{$i['froms']}:</label><br>"; ?>
               <?php echo "<label class='msg'>{$i['msg']}</label>"; ?>           </div>
           <?php } }?>
<style>
    .type{
            padding: 3px;
            margin: 5px;
        }
        .ms{
            color:black;
            margin-left: 15px;
            padding: 5px;
            background-color:burlywood;
            height: 90px;
            width: 500px;
            border-radius: 10px;
            margin-bottom:22px;
        }
        .sender{
            align:left;
            font-size: 25px;
            padding: 4px;
        }
        .msg{
            font-size: 20px;
            padding: 6px;
        }
        .posts{
            display: flex;
            flex-direction: column;
            gap:1em;
        }
    </style>
















<?php
/*echo '<div style="background-color:#fab2ac">';
echo '<p align="left">All comments</p><br>';
$rt="select froms,msg from comments where path='$url';";
$resu=mysqli_query($conn,$rt);
if(mysqli_num_rows($resu)>=1)
{
while($row=mysqli_fetch_assoc($resu))
{
echo "<strong>".($row['froms'])."</strong>".'  commented  '.($row['msg']).'<br>';
}

}
echo '</div>';


echo '<form method="post" >';
echo  '<input type="hidden" name="path" value="'.$url.'">';
echo '<input type="text" name="comment" placeholder="enter your comment" style=" height: 40px; width:280px">';
echo  '<button type="submit" name="comments" >post</button>';
echo '</form>';
echo '<br>';
echo '</div>';
header("location:fdash.php");*/
?>