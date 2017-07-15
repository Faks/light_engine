// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
myBbcodeSettings = {
  nameSpace:          "bbcode", // Useful to prevent multi-instances CSS conflict
  previewParserPath:  "../../../../pages/preview.php",
  markupSet: [
      {name:'Bold', key:'B', openWith:'[b]', closeWith:'[/b]'}, 
      {name:'Italic', key:'I', openWith:'[i]', closeWith:'[/i]'}, 
      {name:'Underline', key:'U', openWith:'[u]', closeWith:'[/u]'}, 
      {separator:'---------------' },
      {name:'Picture', key:'P', replaceWith:'[img][![Url]!][/img]'}, 
      {name:'Link', key:'L', openWith:'[url=[![Url]!]]', closeWith:'[/url]', placeHolder:'Your text to link here...'},
      {separator:'---------------' },
      {name:'Colors', dropMenu: [
          {name:'Yellow', openWith:'[color=yellow]', closeWith:'[/color]', className:"col1-1" },
          {name:'Orange', openWith:'[color=orange]', closeWith:'[/color]', className:"col1-2" },
          {name:'Red', openWith:'[color=red]', closeWith:'[/color]', className:"col1-3" },
          {name:'Blue', openWith:'[color=blue]', closeWith:'[/color]', className:"col2-1" },
          {name:'Purple', openWith:'[color=purple]', closeWith:'[/color]', className:"col2-2" },
          {name:'Green', openWith:'[color=green]', closeWith:'[/color]', className:"col2-3" },
          {name:'White', openWith:'[color=white]', closeWith:'[/color]', className:"col3-1" },
          {name:'Gray', openWith:'[color=gray]', closeWith:'[/color]', className:"col3-2" },
          {name:'Black', openWith:'[color=black]', closeWith:'[/color]', className:"col3-3" }
      ]},
      {name:'Size', dropMenu :[
          {name:'Very Big', openWith:'[size=7]', closeWith:'[/size]' },
          {name:'Big', openWith:'[size=6]', closeWith:'[/size]' },
		  {name:'Medium Big', openWith:'[size=5]', closeWith:'[/size]' },
		  {name:'Medium', openWith:'[size=4]', closeWith:'[/size]' },
		  {name:'Normal', openWith:'[size=3]', closeWith:'[/size]' },
		  {name:'Small', openWith:'[size=2]', closeWith:'[/size]' },
          {name:'Very Small', openWith:'[size=1]', closeWith:'[/size]' }
      ]},
      {separator:'---------------' },
      {name:'Bulleted list', openWith:'[list]\n', closeWith:'\n[/list]'}, 
      {name:'Numeric list', openWith:'[list=[![Starting number]!]]\n', closeWith:'\n[/list]'}, 
      {name:'List item', openWith:'[*] '}, 
      {separator:'---------------' },
      {name:'Quotes', openWith:'[quote]', closeWith:'[/quote]'}, 
	  {name:'Spoiler', openWith:'[spoiler]', closeWith:'[/spoiler]'},
      {separator:'---------------' },
      {name:'Clean', className:"clean", replaceWith:function(h) { return h.selection.replace(/\[(.*?)\]/g, "") } },
      {name:'Preview', className:"preview", call:'preview' }
   ]
}