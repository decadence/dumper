(function()
{
	// дожидаемся загрузки всей страницы
	setTimeout(function()
	{
		var clip_buttons = document.getElementsByClassName("copy-button");
		var clip = new ZeroClipboard(clip_buttons);

		clip.on("load", function(client) {
			console.log("ZC loaded");
			client.on("complete", function(client, args) {
				console.log("Copied!");
			});
		  
			clip.on("dataRequested", function (client, args) {
				client.setText(this.previousElementSibling.innerText);
			});
		});
		
		// откат к JavaScript, если Flash не установлен
		clip.on("noflash", function ( client, args ) {
			var copy_elements = document.getElementsByClassName("copy-link");
			for(var i = 0; i < copy_elements.length; i++)
			{
				copy_elements[i].style.display = "inline-block";
				clip_buttons[i].style.display = "none";
				
				// привязываем ко всем обработчик клика для выдачи окна с текстом для копирования
				copy_elements[i].addEventListener("click", function(ev)
				{
					// выводим текст родителя
					window.prompt("Копировать в буфер обмена: Ctrl+C, Enter", this.parentNode.innerText);
					return false;
				});
			}
		});
		
		
		// использование спойлеров
		if (use_spoiler)
		{
			var spoilers = document.getElementsByClassName("spoiler");
			
			for(var i = 0; i < spoilers.length; i++)
			{
				// показываем ссылки
				spoilers[i].style.display = "block";
				
				// задаём значения по умолчанию для родительского блока
				spoilers[i].parentNode.style.height = "20px";
				spoilers[i].parentNode.style.overflow = "hidden";
				
				// toggle'им высоту родителя
				spoilers[i].addEventListener("click", function(ev)
				{
					var parent_height = this.parentNode.style.height;
					var parent_overflow = this.parentNode.style.overflow;
					this.parentNode.style.height = (parent_height == "20px") ? height : "20px";
					this.parentNode.style.overflow = (parent_overflow == "auto") ? "hidden" : "auto";
					return false;
				});
			}
		}
		
		console.log("Initialized");
		
	}, 2000);
})();