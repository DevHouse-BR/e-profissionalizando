<?php if(isset($date)){ ?>
<div class="result">
<b>De <?php echo $date; ?></b>
<br />
Ao todo <b><?php echo count($qtdo); ?></b> conclusoes foram realizadas.
<br /><br />
<strong>Total de <?php echo $formatacao->moeda($valor); ?></strong>
</div>
<?php } ?>
<?php echo $this->Form->create('ClientsCourse');?>
	<fieldset>
 		<legend><?php __('Gerador de relatorio'); ?></legend>
		<div class="input date"><label for="ClientsCourseConclusaoMonth">De:</label><select name="data[ClientsCourse][de][day]" id="ClientsCourseConclusaoDay">
		<option value="01">1</option>
		<option value="02">2</option>
		<option value="03">3</option>
		<option value="04">4</option>

		<option value="05">5</option>
		<option value="06">6</option>
		<option value="07">7</option>
		<option value="08">8</option>
		<option value="09">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>

		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>

		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>

		</select>-<select name="data[ClientsCourse][de][month]" id="ClientsCourseConclusaoMonth">
		<option value="01">Janeiro</option>
		<option value="02">Fevereiro</option>
		<option value="03">Marco</option>
		<option value="04">Abril</option>
		<option value="05">Maio</option>
		<option value="06">Junho</option>
		<option value="07">Julho</option>
		<option value="08">Agosto</option>
		<option value="09">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
		</select>-<select name="data[ClientsCourse][de][year]" id="ClientsCourseConclusaoYear">
		<option value="2030">2030</option>
		<option value="2029">2029</option>
		<option value="2028">2028</option>
		<option value="2027">2027</option>

		<option value="2026">2026</option>
		<option value="2025">2025</option>
		<option value="2024">2024</option>
		<option value="2023">2023</option>
		<option value="2022">2022</option>
		<option value="2021">2021</option>
		<option value="2020">2020</option>
		<option value="2019">2019</option>
		<option value="2018">2018</option>

		<option value="2017">2017</option>
		<option value="2016">2016</option>
		<option value="2015">2015</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
		<option value="2012">2012</option>
		<option value="2011">2011</option>
		<option value="2010" selected="selected">2010</option>
		</select></div>
		
		
		
		
		
		
		
		<div class="input date"><label for="ClientsCourseConclusaoMonth">Ate:</label><select name="data[ClientsCourse][ate][day]" id="ClientsCourseConclusaoDay">
		<option value="01">1</option>
		<option value="02">2</option>
		<option value="03">3</option>
		<option value="04">4</option>

		<option value="05">5</option>
		<option value="06">6</option>
		<option value="07">7</option>
		<option value="08">8</option>
		<option value="09">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>

		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>

		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>

		</select>-<select name="data[ClientsCourse][ate][month]" id="ClientsCourseConclusaoMonth">
		<option value="01">Janeiro</option>
		<option value="02">Fevereiro</option>
		<option value="03">Marco</option>
		<option value="04">Abril</option>
		<option value="05">Maio</option>
		<option value="06">Junho</option>
		<option value="07">Julho</option>
		<option value="08">Agosto</option>

		<option value="09">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
		</select>-<select name="data[ClientsCourse][ate][year]" id="ClientsCourseConclusaoYear">
		<option value="2030">2030</option>
		<option value="2029">2029</option>
		<option value="2028">2028</option>
		<option value="2027">2027</option>

		<option value="2026">2026</option>
		<option value="2025">2025</option>
		<option value="2024">2024</option>
		<option value="2023">2023</option>
		<option value="2022">2022</option>
		<option value="2021">2021</option>
		<option value="2020">2020</option>
		<option value="2019">2019</option>
		<option value="2018">2018</option>

		<option value="2017">2017</option>
		<option value="2016">2016</option>
		<option value="2015">2015</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
		<option value="2012">2012</option>
		<option value="2011">2011</option>
		<option value="2010" selected="selected">2010</option>

		</select></div>
		
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>