<?
// префикс для правильных путей
define("PREFIX", "/dumper");


/*
Переменная для распечатки
Имя переменной для вывода в начале, так как получить имя автоматически затруднительно
Размер раскрывшегося блока
Использовать ссылку-спойлер вместо наведения

3 и 4 параметр действуют только для первого вызова функции.
*/


function dump($var, $name="Переменная", $height=500, $use_spoiler=false)
{
	static $first_run = true;
	ob_start();
	var_dump($var);
	$result = ob_get_clean();
	?><div class="dump"><?=$name?><br><?=$result?>
	<a class="copy-link">Копировать</a><a class="spoiler">↑↓</a></div>
	<a class="copy-button">Копировать</a><br>
<?
	// выводим стили и скрипты только при первом вызове функции
	if ($first_run)
	{
?>
	<link href="<?=PREFIX?>/zerocp-style.css" rel="stylesheet" />
	
	<?
	
	// если не используется спойлер, прописываем изменение высоты на hover контейнера с текстом ошибки
	if (!$use_spoiler)
	{
		echo '<style>div.dump:hover{height:'.$height.'px;overflow:auto;}</style>';
	}
	
	?>
	
	<script src="<?=PREFIX?>/zerocp-main.js"></script>
	
	<script>
	ZeroClipboard.setDefaults({ moviePath: "<?=PREFIX?>/zeroclipboard.swf" });
	
	var height = "<?=$height;?>px";
	var use_spoiler = <?=$use_spoiler ? "true" : "false"?>;
	
	</script>
	
	<script src="<?=PREFIX?>/zerocp-loader.js"></script>
	
<?
	$first_run = false;
	}
}