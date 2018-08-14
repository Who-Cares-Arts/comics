<?php
	/*
		FLOWERPOT v. 1.0.0.0
		Written by: Tony Mendoza
		FlowerPot is released under the MIT License.

		Copyright (c) 2014 Who Cares? Arts

		Permission is hereby granted, free of charge, to any person obtaining a copy
		of this software and associated documentation files (the "Software"), to deal
		in the Software without restriction, including without limitation the rights
		to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
		copies of the Software, and to permit persons to whom the Software is furnished
		to do so, subject to the following conditions:

		The above copyright notice and this permission notice shall be included in all
		copies or substantial portions of the Software.

		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
	*/

	/*
		File is saved as a text (.txt) file so that you can actually see the flowerpot code.
		Save it as a PHP (.php) file on your server so that you can easily create HTML using PHP.

		NOTE: SCRIPT() and related functions have a problem which does not actually call the code inside.
				Use <script> tag instead.
	*/

	function FLOWERPOT_PRINT_VERSION(){
			echo $spacing."1.0";
		}

	$spacing = ""; // Used for automatically formating when creating new elements. Use '\\t' to add to $spacing.
	$enableSpacing = "false"; // Set to determine whether an element should have spacing before being written.
	// Use this to determine what attributes you want your code to recognize, comment to leave attribute out of array.
	$selectedAttributes = array(
		"accesskey",
		"class",
		"contenteditable",
		"dir",
		"draggable",
		"href",
		"id",
		"lang",
		"media",
		"name",
		"placeholder",
		"rel",
		"role",
		"spellcheck",
		"src",
		"style",
		"tabindex",
		"title",
		"type",
		"translate",
		"value"
	);

	// Call this to add a space, '\\t' character, to $spacing
	function AddSpacing()
	{
		$GLOBALS["spacing"] = $GLOBALS["spacing"]."\t";
	}
	
	// Call this to remove a space, '\\t' character, from $spacing
	function RemoveSpacing()
	{
		$GLOBALS["spacing"] = substr($GLOBALS["spacing"], 1);
	}
	
	// Writes a string that ends with a line break, '\\n' character.
	function WriteLine($string)
	{
		$break = "";
		if (headers_sent())
			$break = "\n";
		if ($GLOBALS["enableSpacing"] == "true")
			echo $break.$GLOBALS["spacing"].$string;
		else
			echo $break.$string;
	}

	// Writes a string
	function Write($string)
	{
		echo $string;
	}

	// Creates a basic tag based on parameters given. The founding block for the other tags.
	// TAG creates a begin and end tag for an html element.
	// TAG_Begin creates the begin element for an html element, accepting most default attributes as a key/value pair and extra attributes as string.
	//  InnerHTML may also be assigned a string value for 
	function TAG($name, $attributes = NULL, $extraAttributes = NULL, $innerHTML = NULL)
	{
		TAG_Begin($name, $attributes, $extraAttributes, $innerHTML);
		TAG_End($name);
	}
	function TAG_Begin($name, $attributes = array(), $extraAttributes = NULL, $innerHTML = NULL)
	{
                $attrString = "";
                foreach ($GLOBALS["selectedAttributes"] as $attr)
                {
	                if(!empty($attributes[$attr]))
        			$attrString = $attrString.$attr."=\"".$attributes[$attr]."\" ";
        	}
		WriteLine("<".$name);
		if(!empty($attrString) || !empty($extraAttributes))
			Write(" ".$attrString.$extraAttributes);
		Write(">");
		AddSpacing();
		if(!empty($innerHTML))
			WriteLine($innerHTML);
	}
	function TAG_End($name)
	{
		RemoveSpacing();
		WriteLine("</".$name.">");
	}
	
	// Sets up the DOCTYPE
	function DOCTYPE($type = "h")
	{
		$GLOBALS["enableSpacing"] = "false";
		if ($type == "hs")
			TAG_Begin("!DOCTYPE", NULL, "HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\"");
		else if ($type == "ht")
			TAG_Begin("!DOCTYPE", NULL, "HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\"");
		else if ($type == "hf")
			TAG_Begin("!DOCTYPE", NULL, "HTML PUBLIC \"-//W3C//DTD HTML 4.01 Frameset//EN\" \"http://www.w3.org/TR/html4/frameset.dtd\"");
		else if ($type == "xs")
			TAG_Begin("!DOCTYPE", NULL, "html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\"");
		else if ($type == "xt")
			TAG_Begin("!DOCTYPE", NULL, "html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"");
		else if ($type == "xf")
			TAG_Begin("!DOCTYPE", NULL, "html PUBLIC \"-//W3C//DTD XHTML 1.0 Frameset//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd\"");
		else if ($type == "x")
			TAG_Begin("!DOCTYPE", NULL, "html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\"");
		else
			TAG_Begin("!DOCTYPE", NULL, "html");		
	}
	
	// HTML tags
	function HTML_Begin()
	{
		$GLOBALS["enableSpacing"] = "false";
		TAG_Begin("html", "id='html' lang=\"en-US\"");
	}
	function HTML_End()
	{
		$GLOBALS["enableSpacing"] = "false";
		TAG_End("html");
	}
	
	// Head tags
	function HEAD_Begin()
	{
		$GLOBALS["enableSpacing"] = "false";
		$GLOBALS["spacing"] = "\t";
		WriteLine("<head>");
		$GLOBALS["enableSpacing"] = "true";
	}
	function HEAD_End()
	{
		$GLOBALS["enableSpacing"] = "false";
		$GLOBALS["spacing"] = "";
		TAG_End("head");
	}
	
	// Body tags
	function BODY_Begin($style = NULL, $events = NULL)
	{
		$GLOBALS["enableSpacing"] = "false";
		if(!empty($events))
			TAG_Begin("body", $events." style=\"".$style."\"");
		else if(!empty($style))
			TAG_Begin("body", "style=\"".$style."\"");
		else
			TAG_Begin("body");
		$GLOBALS["spacing"] = "\t";
		$GLOBALS["enableSpacing"] = "true";
	}
	function BODY_End()
	{
		$GLOBALS["enableSpacing"] = "false";
		$GLOBALS["spacing"] = "";
		TAG_End("body");
	}
	
	// Script tags
	function SCRIPT($source, $defer=NULL, $type=NULL)
	{
		$deferAttr = '';
		if(!empty($defer))
			$deferAttr = 'defer';
		if(!empty($type))
			TAG("script", "src=\"".$source."\" type=\"".$type."\" ".$deferAttr);
		else
			TAG("script", "src=\"".$source."\"".$deferAttr);
	}
	function SCRIPT_Begin($type = NULL)
	{
		if(!empty($type))
			TAG_Begin("script", "type=\"".$type."\"");
		else
			TAG_Begin("script");
	}
	function SCRIPT_End()
	{
		RemoveSpacing();
		TAG_End("script");
	}
	
	// Style tags
	function STYLE_Begin()
	{
		TAG_Begin("style");
	}
	function STYLE_End()
	{
		RemoveSpacing();
		TAG_End("style");
	}
	
	// Comment Tags
	function COMMENT_Begin()
	{
		Write("<!--");
	}
	function COMMENT_End()
	{
		Write("-->");
	};

		// DIV tags
	function DIV_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("div", $attributes, $extraAttributes);	}
	function DIV_End()
	{	TAG_End("div");	}

	// SPAN tags
	function SPAN_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("span", $attributes, $extraAttributes);	}
	function SPAN_End()
	{	TAG_End("span");	}

	// IFRAME tags
	function IFRAME_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("iframe", $attributes, $extraAttributes);	}
	function IFRAME_End()
	{	TAG_End("iframe");	}

	// A tags
	function A_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("a", $attributes, $extraAttributes);	}
	function A_End()
	{	TAG_End("a");	}

	// ABBR tags
	function ABBR_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("abbr", $attributes, $extraAttributes);	}
	function ABBR_End()
	{	TAG_End("abbr");	}

	// ADDRESS tags
	function ADDRESS_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("address", $attributes, $extraAttributes);	}
	function ADDRESS_End()
	{	TAG_End("address");	}

	// AREA tags
	function AREA_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("area", $attributes, $extraAttributes);	}
	function AREA_End()
	{	TAG_End("area");	}

	// ARTICLE tags
	function ARTICLE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("article", $attributes, $extraAttributes);	}
	function ARTICLE_End()
	{	TAG_End("article");	}

	// ASIDE tags
	function ASIDE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("aside", $attributes, $extraAttributes);	}
	function ASIDE_End()
	{	TAG_End("aside");	}

	// AUDIO tags
	function AUDIO_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("audio", $attributes, $extraAttributes);	}
	function AUDIO_End()
	{	TAG_End("audio");	}

	// B tags
	function B_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("b", $attributes, $extraAttributes);	}
	function B_End()
	{	TAG_End("b");	}

	// BASE tags
	function BASE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("base", $attributes, $extraAttributes);	}
	function BASE_End()
	{	TAG_End("base");	}

	// BDI tags
	function BDI_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("bdi", $attributes, $extraAttributes);	}
	function BDI_End()
	{	TAG_End("bdi");	}

	// BDO tags
	function BDO_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("bdo", $attributes, $extraAttributes);	}
	function BDO_End()
	{	TAG_End("bdo");	}

	// BLOCKQUOTE tags
	function BLOCKQUOTE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("blockquote", $attributes, $extraAttributes);	}
	function BLOCKQUOTE_End()
	{	TAG_End("blockquote");	}

	// BR tags
	function BR_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("br", $attributes, $extraAttributes);	}
	function BR_End()
	{	TAG_End("br");	}

	// BUTTON tags
	function BUTTON_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("button", $attributes, $extraAttributes);	}
	function BUTTON_End()
	{	TAG_End("button");	}

	// CANVAS tags
	function CANVAS_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("canvas", $attributes, $extraAttributes);	}
	function CANVAS_End()
	{	TAG_End("canvas");	}

	// CAPTION tags
	function CAPTION_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("caption", $attributes, $extraAttributes);	}
	function CAPTION_End()
	{	TAG_End("caption");	}

	// CITE tags
	function CITE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("cite", $attributes, $extraAttributes);	}
	function CITE_End()
	{	TAG_End("cite");	}

	// CODE tags
	function CODE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("code", $attributes, $extraAttributes);	}
	function CODE_End()
	{	TAG_End("code");	}

	// COL tags
	function COL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("col", $attributes, $extraAttributes);	}
	function COL_End()
	{	TAG_End("col");	}

	// COLGROUP tags
	function COLGROUP_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("colgroup", $attributes, $extraAttributes);	}
	function COLGROUP_End()
	{	TAG_End("colgroup");	}

	// DATALIST tags
	function DATALIST_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("datalist", $attributes, $extraAttributes);	}
	function DATALIST_End()
	{	TAG_End("datalist");	}

	// DD tags
	function DD_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("dd", $attributes, $extraAttributes);	}
	function DD_End()
	{	TAG_End("dd");	}

	// DEL tags
	function DEL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("del", $attributes, $extraAttributes);	}
	function DEL_End()
	{	TAG_End("del");	}

	// DETAILS tags
	function DETAILS_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("details", $attributes, $extraAttributes);	}
	function DETAILS_End()
	{	TAG_End("details");	}

	// DFN tags
	function DFN_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("dfn", $attributes, $extraAttributes);	}
	function DFN_End()
	{	TAG_End("dfn");	}

	// DIALOG tags
	function DIALOG_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("dialog", $attributes, $extraAttributes);	}
	function DIALOG_End()
	{	TAG_End("dialog");	}

	// DL tags
	function DL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("dl", $attributes, $extraAttributes);	}
	function DL_End()
	{	TAG_End("dl");	}

	// DT tags
	function DT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("dt", $attributes, $extraAttributes);	}
	function DT_End()
	{	TAG_End("dt");	}

	// EM tags
	function EM_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("em", $attributes, $extraAttributes);	}
	function EM_End()
	{	TAG_End("em");	}

	// EMBED tags
	function EMBED_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("embed", $attributes, $extraAttributes);	}
	function EMBED_End()
	{	TAG_End("embed");	}

	// FIELDSET tags
	function FIELDSET_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("fieldset", $attributes, $extraAttributes);	}
	function FIELDSET_End()
	{	TAG_End("fieldset");	}

	// FIGCAPTION tags
	function FIGCAPTION_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("figcaption", $attributes, $extraAttributes);	}
	function FIGCAPTION_End()
	{	TAG_End("figcaption");	}

	// FIGURE tags
	function FIGURE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("figure", $attributes, $extraAttributes);	}
	function FIGURE_End()
	{	TAG_End("figure");	}

	// FONT tags
	function FONT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("font", $attributes, $extraAttributes);	}
	function FONT_End()
	{	TAG_End("font");	}

	// FOOTER tags
	function FOOTER_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("footer", $attributes, $extraAttributes);	}
	function FOOTER_End()
	{	TAG_End("footer");	}

	// FORM tags
	function FORM_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("form", $attributes, $extraAttributes);	}
	function FORM_End()
	{	TAG_End("form");	}

	// H1 tags
	function H1_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("h1", $attributes, $extraAttributes);	}
	function H1_End()
	{	TAG_End("h1");	}

	// H2 tags
	function H2_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("h2", $attributes, $extraAttributes);	}
	function H2_End()
	{	TAG_End("h2");	}

	// H3 tags
	function H3_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("h3", $attributes, $extraAttributes);	}
	function H3_End()
	{	TAG_End("h3");	}

	// H4 tags
	function H4_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("h4", $attributes, $extraAttributes);	}
	function H4_End()
	{	TAG_End("h4");	}

	// H5 tags
	function H5_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("h5", $attributes, $extraAttributes);	}
	function H5_End()
	{	TAG_End("h5");	}

	// H6 tags
	function H6_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("h6", $attributes, $extraAttributes);	}
	function H6_End()
	{	TAG_End("h6");	}

	// HEADER tags
	function HEADER_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("header", $attributes, $extraAttributes);	}
	function HEADER_End()
	{	TAG_End("header");	}

	// HR tags
	function HR_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("hr", $attributes, $extraAttributes);	}
	function HR_End()
	{	TAG_End("hr");	}

	// I tags
	function I_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("i", $attributes, $extraAttributes);	}
	function I_End()
	{	TAG_End("i");	}

	// IMG tags
	function IMG_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("img", $attributes, $extraAttributes);	}
	function IMG_End()
	{	TAG_End("img");	}

	// INPUT tags
	function INPUT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("input", $attributes, $extraAttributes);	}
	function INPUT_End()
	{	TAG_End("input");	}

	// INS tags
	function INS_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("ins", $attributes, $extraAttributes);	}
	function INS_End()
	{	TAG_End("ins");	}

	// KBD tags
	function KBD_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("kbd", $attributes, $extraAttributes);	}
	function KBD_End()
	{	TAG_End("kbd");	}

	// KEYGEN tags
	function KEYGEN_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("keygen", $attributes, $extraAttributes);	}
	function KEYGEN_End()
	{	TAG_End("keygen");	}

	// LABEL tags
	function LABEL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("label", $attributes, $extraAttributes);	}
	function LABEL_End()
	{	TAG_End("label");	}

	// LEGEND tags
	function LEGEND_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("legend", $attributes, $extraAttributes);	}
	function LEGEND_End()
	{	TAG_End("legend");	}

	// LI tags
	function LI_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("li", $attributes, $extraAttributes);	}
	function LI_End()
	{	TAG_End("li");	}

	// LINK tags
	function LINK_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("link", $attributes, $extraAttributes);	}
	function LINK_End()
	{	TAG_End("link");	}

	// MAIN tags
	function MAIN_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("main", $attributes, $extraAttributes);	}
	function MAIN_End()
	{	TAG_End("main");	}

	// MAP tags
	function MAP_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("map", $attributes, $extraAttributes);	}
	function MAP_End()
	{	TAG_End("map");	}

	// MARK tags
	function MARK_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("mark", $attributes, $extraAttributes);	}
	function MARK_End()
	{	TAG_End("mark");	}

	// MENU tags
	function MENU_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("menu", $attributes, $extraAttributes);	}
	function MENU_End()
	{	TAG_End("menu");	}

	// MENUITEM tags
	function MENUITEM_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("menuitem", $attributes, $extraAttributes);	}
	function MENUITEM_End()
	{	TAG_End("menuitem");	}

	// META tags
	function META_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("meta", $attributes, $extraAttributes);	}
	function META_End()
	{	TAG_End("meta");	}

	// METER tags
	function METER_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("meter", $attributes, $extraAttributes);	}
	function METER_End()
	{	TAG_End("meter");	}

	// NAV tags
	function NAV_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("nav", $attributes, $extraAttributes);	}
	function NAV_End()
	{	TAG_End("nav");	}

	// NOSCRIPT tags
	function NOSCRIPT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("noscript", $attributes, $extraAttributes);	}
	function NOSCRIPT_End()
	{	TAG_End("noscript");	}

	// OBJECT tags
	function OBJECT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("object", $attributes, $extraAttributes);	}
	function OBJECT_End()
	{	TAG_End("object");	}

	// OL tags
	function OL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("ol", $attributes, $extraAttributes);	}
	function OL_End()
	{	TAG_End("ol");	}

	// OPTGROUP tags
	function OPTGROUP_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("optgroup", $attributes, $extraAttributes);	}
	function OPTGROUP_End()
	{	TAG_End("optgroup");	}

	// OPTION tags
	function OPTION_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("option", $attributes, $extraAttributes);	}
	function OPTION_End()
	{	TAG_End("option");	}

	// OUTPUT tags
	function OUTPUT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("output", $attributes, $extraAttributes);	}
	function OUTPUT_End()
	{	TAG_End("output");	}

	// P tags
	function P_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("p", $attributes, $extraAttributes);	}
	function P_End()
	{	TAG_End("p");	}

	// PARAM tags
	function PARAM_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("param", $attributes, $extraAttributes);	}
	function PARAM_End()
	{	TAG_End("param");	}

	// PRE tags
	function PRE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("pre", $attributes, $extraAttributes);	}
	function PRE_End()
	{	TAG_End("pre");	}

	// PROGRESS tags
	function PROGRESS_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("progress", $attributes, $extraAttributes);	}
	function PROGRESS_End()
	{	TAG_End("progress");	}

	// Q tags
	function Q_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("q", $attributes, $extraAttributes);	}
	function Q_End()
	{	TAG_End("q");	}

	// RP tags
	function RP_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("rp", $attributes, $extraAttributes);	}
	function RP_End()
	{	TAG_End("rp");	}

	// RT tags
	function RT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("rt", $attributes, $extraAttributes);	}
	function RT_End()
	{	TAG_End("rt");	}

	// RUBY tags
	function RUBY_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("ruby", $attributes, $extraAttributes);	}
	function RUBY_End()
	{	TAG_End("ruby");	}

	// S tags
	function S_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("s", $attributes, $extraAttributes);	}
	function S_End()
	{	TAG_End("s");	}

	// SAMP tags
	function SAMP_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("samp", $attributes, $extraAttributes);	}
	function SAMP_End()
	{	TAG_End("samp");	}

	// SECTION tags
	function SECTION_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("section", $attributes, $extraAttributes);	}
	function SECTION_End()
	{	TAG_End("section");	}

	// SELECT tags
	function SELECT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("select", $attributes, $extraAttributes);	}
	function SELECT_End()
	{	TAG_End("select");	}

	// SMALL tags
	function SMALL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("small", $attributes, $extraAttributes);	}
	function SMALL_End()
	{	TAG_End("small");	}

	// SOURCE tags
	function SOURCE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("source", $attributes, $extraAttributes);	}
	function SOURCE_End()
	{	TAG_End("source");	}

	// STRONG tags
	function STRONG_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("strong", $attributes, $extraAttributes);	}
	function STRONG_End()
	{	TAG_End("strong");	}

	// SUB tags
	function SUB_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("sub", $attributes, $extraAttributes);	}
	function SUB_End()
	{	TAG_End("sub");	}

	// SUMMARY tags
	function SUMMARY_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("summary", $attributes, $extraAttributes);	}
	function SUMMARY_End()
	{	TAG_End("summary");	}

	// SUP tags
	function SUP_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("sup", $attributes, $extraAttributes);	}
	function SUP_End()
	{	TAG_End("sup");	}

	// TABLE tags
	function TABLE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("table", $attributes, $extraAttributes);	}
	function TABLE_End()
	{	TAG_End("table");	}

	// TBODY tags
	function TBODY_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("tbody", $attributes, $extraAttributes);	}
	function TBODY_End()
	{	TAG_End("tbody");	}

	// TD tags
	function TD_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("td", $attributes, $extraAttributes);	}
	function TD_End()
	{	TAG_End("td");	}

	// TEXTAREA tags
	function TEXTAREA_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("textarea", $attributes, $extraAttributes);	}
	function TEXTAREA_End()
	{	TAG_End("textarea");	}

	// TFOOT tags
	function TFOOT_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("tfoot", $attributes, $extraAttributes);	}
	function TFOOT_End()
	{	TAG_End("tfoot");	}

	// TH tags
	function TH_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("th", $attributes, $extraAttributes);	}
	function TH_End()
	{	TAG_End("th");	}

	// THEAD tags
	function THEAD_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("thead", $attributes, $extraAttributes);	}
	function THEAD_End()
	{	TAG_End("thead");	}

	// TIME tags
	function TIME_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("time", $attributes, $extraAttributes);	}
	function TIME_End()
	{	TAG_End("time");	}

	// TITLE tags
	function TITLE($text)
	{
        TAG_Begin("title", null, null);
        WriteLine($text);
        TAG_End("title");
    }
	function TITLE_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("title", $attributes, $extraAttributes);	}
	function TITLE_End()
	{	TAG_End("title");	}

	// TR tags
	function TR_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("tr", $attributes, $extraAttributes);	}
	function TR_End()
	{	TAG_End("tr");	}

	// TRACK tags
	function TRACK_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("track", $attributes, $extraAttributes);	}
	function TRACK_End()
	{	TAG_End("track");	}

	// U tags
	function U_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("u", $attributes, $extraAttributes);	}
	function U_End()
	{	TAG_End("u");	}

	// UL tags
	function UL_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("ul", $attributes, $extraAttributes);	}
	function UL_End()
	{	TAG_End("ul");	}

	// VAR tags
	function VAR_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("var", $attributes, $extraAttributes);	}
	function VAR_End()
	{	TAG_End("var");	}

	// VIDEO tags
	function VIDEO_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("video", $attributes, $extraAttributes);	}
	function VIDEO_End()
	{	TAG_End("video");	}

	// WBR tags
	function WBR_Begin($attributes = array(), $extraAttributes = NULL)
	{	TAG_Begin("wbr", $attributes, $extraAttributes);	}
	function WBR_End()
	{	TAG_End("wbr");	}
?>