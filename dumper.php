<?
// префикс для правильных путей, путь к папке
define("PREFIX", "/dumper");


/*
$var
	Переменная для распечатки
$name
	Имя переменной для вывода в начале, так как получить имя автоматически затруднительно
$height
	Размер раскрывшегося блока
$use_spoiler
	Использовать ссылку-спойлер вместо наведения
	
$height и $use_spoiler действуют только для первого вызова функции.
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
	
	// если не используется спойлер, прописываем изменение высоты на hover контейнера
	if (!$use_spoiler)
	{
	?>
		<style>
		div.dump:hover
		{
			height: <?=$height?>px;
			overflow: auto;
		}
		</style>
	<?
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