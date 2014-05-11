<?php
	// On récupère les commentaires
	$requetComRecent = "SELECT * FROM commentaire ORDER BY DateCom Desc ";
	$resultComRecent = mysql_query($requetComRecent) or die ("Erreur de la base de données.");
?>

<div class="grid_3 omega sidebar sidebar_a">
	<div class="widget">
		<ul class="counter clearfix">
			<li class="twitter">
				<a href="index.html#"><i class="fa fa-twitter"></i></a>
				<span> 2545 <br> Followes </span>
			</li>
			<li class="facebook">
				<a href="index.html#"><i class="fa fa-facebook"></i></a>
				<span> 1317 <br> Likes </span>
			</li>
		</ul>
	</div><!-- widget réseaux sociaux -->

	<div class="widget">
		<div id="calendar_wrap"><table id="wp-calendar">
			<caption>Avril 2014</caption>
				<thead>
					<tr>
						<th scope="col" title="Monday">L</th>
						<th scope="col" title="Tuesday">M</th>
						<th scope="col" title="Wednesday">M</th>
						<th scope="col" title="Thursday">J</th>
						<th scope="col" title="Friday">V</th>
						<th scope="col" title="Saturday">S</th>
						<th scope="col" title="Sunday">D</th>
					</tr>
				</thead>
		
				<tfoot>
					<tr>
						<td colspan="3" id="prev"><a href="index.html#" title="View posts for December 2013">« Dec</a></td>
						<td class="pad">&nbsp;</td>
						<td colspan="3" id="next" class="pad">&nbsp;</td>
					</tr>
				</tfoot>
		
				<tbody>
					<tr><td colspan="2" class="pad">&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
					<tr><td>6</td><td>7</td><td id="today">8</td><td>9</td><td>10</td><td>11</td><td>12</td></tr>
					<tr><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td></tr>
					<tr><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td></tr>
					<tr><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td class="pad" colspan="2">&nbsp;</td></tr>
				</tbody>
			</table>
		</div>
	</div><!-- widget calendrier -->
	<div class="widget">
		<div class="title"><h4>Commentaires récents</h4></div>
		<ul class="recent_comments small_posts">
			
				<?php 
				while ($commentaireRecent=mysql_fetch_row($resultComRecent)){					
					?><li class="clearfix"><div class="commentaireRecent">
						<div class="photoProfil"><?php
						echo "<img width='80' height'80' src='../imgProfil/".$photoProfil[2].".jpg'>";
					?></div> <?php	
						echo "<p><strong>".$photoProfil[1]." ".$photoProfil[0]."</strong></p>";
						echo "<p>".substr($commentaireRecent[3], 0, 15)."</p>";
					?></div></li><?php	
				} 
				?>
			
		</ul>
	</div><!-- /widget commentaires récents -->
</div><!-- /grid3 barre latérale -->	

