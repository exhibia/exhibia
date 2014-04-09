/*jslint devel: true, bitwise: true, regexp: true, browser: true, confusion: true, unparam: true, eqeq: true, white: true, nomen: true, plusplus: true, maxerr: 50, indent: 4 */
/*globals jQuery,Color */

/*
 * ColorPicker
 *
 * Copyright (c) 2011-2013 Martijn W. van der Lee
 * Licensed under the MIT.
 *
 * Full-featured colorpicker for jQueryUI with full theming support.
 * Most images from jPicker by Christopher T. Tillman.
 * Sourcecode created from scratch by Martijn W. van der Lee.
 */

(function ($) {
	"use strict";

	$.colorpicker = new function() {
	  
	  
		this.regional = [];
		this.regional[''] =	{
			ok:				'OK',
			cancel:			'Cancel',
			none:			'None',
			button:			'Color',
			title:			'Pick a color',
			transparent:	'Transparent',
			hsvH:			'H',
			hsvS:			'S',
			hsvV:			'V',
			rgbR:			'R',
			rgbG:			'G',
			rgbB:			'B',
			labL:			'L',
			labA:			'a',
			labB:			'b',
			hslH:			'H',
			hslS:			'S',
			hslL:			'L',
			cmykC:			'C',
			cmykM:			'M',
			cmykY:			'Y',
			cmykK:			'K',
			alphaA:			'A'
		};

		this.swatches = [];
		this.swatches['html'] = {
			'black':				{r: 0, g: 0, b: 0},
			'dimgray':				{r: 0.4117647058823529, g: 0.4117647058823529, b: 0.4117647058823529},
			'gray':					{r: 0.5019607843137255, g: 0.5019607843137255, b: 0.5019607843137255},
			'darkgray':				{r: 0.6627450980392157, g: 0.6627450980392157, b: 0.6627450980392157},
			'silver':				{r: 0.7529411764705882, g: 0.7529411764705882, b: 0.7529411764705882},
			'lightgrey':			{r: 0.8274509803921568, g: 0.8274509803921568, b: 0.8274509803921568},
			'gainsboro':			{r: 0.8627450980392157, g: 0.8627450980392157, b: 0.8627450980392157},
			'whitesmoke':			{r: 0.9607843137254902, g: 0.9607843137254902, b: 0.9607843137254902},
			'white':				{r: 1, g: 1, b: 1},
			'rosybrown':			{r: 0.7372549019607844, g: 0.5607843137254902, b: 0.5607843137254902},
			'indianred':			{r: 0.803921568627451, g: 0.3607843137254902, b: 0.3607843137254902},
			'brown':				{r: 0.6470588235294118, g: 0.16470588235294117, b: 0.16470588235294117},
			'firebrick':			{r: 0.6980392156862745, g: 0.13333333333333333, b: 0.13333333333333333},
			'lightcoral':			{r: 0.9411764705882353, g: 0.5019607843137255, b: 0.5019607843137255},
			'maroon':				{r: 0.5019607843137255, g: 0, b: 0},
			'darkred':				{r: 0.5450980392156862, g: 0, b: 0},
			'red':					{r: 1, g: 0, b: 0},
			'snow':					{r: 1, g: 0.9803921568627451, b: 0.9803921568627451},
			'salmon':				{r: 0.9803921568627451, g: 0.5019607843137255, b: 0.4470588235294118},
			'mistyrose':			{r: 1, g: 0.8941176470588236, b: 0.8823529411764706},
			'tomato':				{r: 1, g: 0.38823529411764707, b: 0.2784313725490196},
			'darksalmon':			{r: 0.9137254901960784, g: 0.5882352941176471, b: 0.47843137254901963},
			'orangered':			{r: 1, g: 0.27058823529411763, b: 0},
			'coral':				{r: 1, g: 0.4980392156862745, b: 0.3137254901960784},
			'lightsalmon':			{r: 1, g: 0.6274509803921569, b: 0.47843137254901963},
			'sienna':				{r: 0.6274509803921569, g: 0.3215686274509804, b: 0.17647058823529413},
			'seashell':				{r: 1, g: 0.9607843137254902, b: 0.9333333333333333},
			'chocolate':			{r: 0.8235294117647058, g: 0.4117647058823529, b: 0.11764705882352941},
			'saddlebrown':			{r: 0.5450980392156862, g: 0.27058823529411763, b: 0.07450980392156863},
			'sandybrown':			{r: 0.9568627450980393, g: 0.6431372549019608, b: 0.3764705882352941},
			'peachpuff':			{r: 1, g: 0.8549019607843137, b: 0.7254901960784313},
			'peru':					{r: 0.803921568627451, g: 0.5215686274509804, b: 0.24705882352941178},
			'linen':				{r: 0.9803921568627451, g: 0.9411764705882353, b: 0.9019607843137255},
			'darkorange':			{r: 1, g: 0.5490196078431373, b: 0},
			'bisque':				{r: 1, g: 0.8941176470588236, b: 0.7686274509803922},
			'burlywood':			{r: 0.8705882352941177, g: 0.7215686274509804, b: 0.5294117647058824},
			'tan':					{r: 0.8235294117647058, g: 0.7058823529411765, b: 0.5490196078431373},
			'antiquewhite':			{r: 0.9803921568627451, g: 0.9215686274509803, b: 0.8431372549019608},
			'navajowhite':			{r: 1, g: 0.8705882352941177, b: 0.6784313725490196},
			'blanchedalmond':		{r: 1, g: 0.9215686274509803, b: 0.803921568627451},
			'papayawhip':			{r: 1, g: 0.9372549019607843, b: 0.8352941176470589},
			'orange':				{r: 1, g: 0.6470588235294118, b: 0},
			'moccasin':				{r: 1, g: 0.8941176470588236, b: 0.7098039215686275},
			'wheat':				{r: 0.9607843137254902, g: 0.8705882352941177, b: 0.7019607843137254},
			'oldlace':				{r: 0.9921568627450981, g: 0.9607843137254902, b: 0.9019607843137255},
			'floralwhite':			{r: 1, g: 0.9803921568627451, b: 0.9411764705882353},
			'goldenrod':			{r: 0.8549019607843137, g: 0.6470588235294118, b: 0.12549019607843137},
			'darkgoldenrod':		{r: 0.7215686274509804, g: 0.5254901960784314, b: 0.043137254901960784},
			'cornsilk':				{r: 1, g: 0.9725490196078431, b: 0.8627450980392157},
			'gold':					{r: 1, g: 0.8431372549019608, b: 0},
			'palegoldenrod':		{r: 0.9333333333333333, g: 0.9098039215686274, b: 0.6666666666666666},
			'khaki':				{r: 0.9411764705882353, g: 0.9019607843137255, b: 0.5490196078431373},
			'lemonchiffon':			{r: 1, g: 0.9803921568627451, b: 0.803921568627451},
			'darkkhaki':			{r: 0.7411764705882353, g: 0.7176470588235294, b: 0.4196078431372549},
			'beige':				{r: 0.9607843137254902, g: 0.9607843137254902, b: 0.8627450980392157},
			'lightgoldenrodyellow':	{r: 0.9803921568627451, g: 0.9803921568627451, b: 0.8235294117647058},
			'olive':				{r: 0.5019607843137255, g: 0.5019607843137255, b: 0},
			'yellow':				{r: 1, g: 1, b: 0},
			'lightyellow':			{r: 1, g: 1, b: 0.8784313725490196},
			'ivory':				{r: 1, g: 1, b: 0.9411764705882353},
			'olivedrab':			{r: 0.4196078431372549, g: 0.5568627450980392, b: 0.13725490196078433},
			'yellowgreen':			{r: 0.6039215686274509, g: 0.803921568627451, b: 0.19607843137254902},
			'darkolivegreen':		{r: 0.3333333333333333, g: 0.4196078431372549, b: 0.1843137254901961},
			'greenyellow':			{r: 0.6784313725490196, g: 1, b: 0.1843137254901961},
			'lawngreen':			{r: 0.48627450980392156, g: 0.9882352941176471, b: 0},
			'chartreuse':			{r: 0.4980392156862745, g: 1, b: 0},
			'darkseagreen':			{r: 0.5607843137254902, g: 0.7372549019607844, b: 0.5607843137254902},
			'forestgreen':			{r: 0.13333333333333333, g: 0.5450980392156862, b: 0.13333333333333333},
			'limegreen':			{r: 0.19607843137254902, g: 0.803921568627451, b: 0.19607843137254902},
			'lightgreen':			{r: 0.5647058823529412, g: 0.9333333333333333, b: 0.5647058823529412},
			'palegreen':			{r: 0.596078431372549, g: 0.984313725490196, b: 0.596078431372549},
			'darkgreen':			{r: 0, g: 0.39215686274509803, b: 0},
			'green':				{r: 0, g: 0.5019607843137255, b: 0},
			'lime':					{r: 0, g: 1, b: 0},
			'honeydew':				{r: 0.9411764705882353, g: 1, b: 0.9411764705882353},
			'mediumseagreen':		{r: 0.23529411764705882, g: 0.7019607843137254, b: 0.44313725490196076},
			'seagreen':				{r: 0.1803921568627451, g: 0.5450980392156862, b: 0.3411764705882353},
			'springgreen':			{r: 0, g: 1, b: 0.4980392156862745},
			'mintcream':			{r: 0.9607843137254902, g: 1, b: 0.9803921568627451},
			'mediumspringgreen':	{r: 0, g: 0.9803921568627451, b: 0.6039215686274509},
			'mediumaquamarine':		{r: 0.4, g: 0.803921568627451, b: 0.6666666666666666},
			'aquamarine':			{r: 0.4980392156862745, g: 1, b: 0.8313725490196079},
			'turquoise':			{r: 0.25098039215686274, g: 0.8784313725490196, b: 0.8156862745098039},
			'lightseagreen':		{r: 0.12549019607843137, g: 0.6980392156862745, b: 0.6666666666666666},
			'mediumturquoise':		{r: 0.2823529411764706, g: 0.8196078431372549, b: 0.8},
			'darkslategray':		{r: 0.1843137254901961, g: 0.30980392156862746, b: 0.30980392156862746},
			'paleturquoise':		{r: 0.6862745098039216, g: 0.9333333333333333, b: 0.9333333333333333},
			'teal':					{r: 0, g: 0.5019607843137255, b: 0.5019607843137255},
			'darkcyan':				{r: 0, g: 0.5450980392156862, b: 0.5450980392156862},
			'darkturquoise':		{r: 0, g: 0.807843137254902, b: 0.8196078431372549},
			'aqua':					{r: 0, g: 1, b: 1},
			'cyan':					{r: 0, g: 1, b: 1},
			'lightcyan':			{r: 0.8784313725490196, g: 1, b: 1},
			'azure':				{r: 0.9411764705882353, g: 1, b: 1},
			'cadetblue':			{r: 0.37254901960784315, g: 0.6196078431372549, b: 0.6274509803921569},
			'powderblue':			{r: 0.6901960784313725, g: 0.8784313725490196, b: 0.9019607843137255},
			'lightblue':			{r: 0.6784313725490196, g: 0.8470588235294118, b: 0.9019607843137255},
			'deepskyblue':			{r: 0, g: 0.7490196078431373, b: 1},
			'skyblue':				{r: 0.5294117647058824, g: 0.807843137254902, b: 0.9215686274509803},
			'lightskyblue':			{r: 0.5294117647058824, g: 0.807843137254902, b: 0.9803921568627451},
			'steelblue':			{r: 0.27450980392156865, g: 0.5098039215686274, b: 0.7058823529411765},
			'aliceblue':			{r: 0.9411764705882353, g: 0.9725490196078431, b: 1},
			'dodgerblue':			{r: 0.11764705882352941, g: 0.5647058823529412, b: 1},
			'slategray':			{r: 0.4392156862745098, g: 0.5019607843137255, b: 0.5647058823529412},
			'lightslategray':		{r: 0.4666666666666667, g: 0.5333333333333333, b: 0.6},
			'lightsteelblue':		{r: 0.6901960784313725, g: 0.7686274509803922, b: 0.8705882352941177},
			'cornflowerblue':		{r: 0.39215686274509803, g: 0.5843137254901961, b: 0.9294117647058824},
			'royalblue':			{r: 0.2549019607843137, g: 0.4117647058823529, b: 0.8823529411764706},
			'midnightblue':			{r: 0.09803921568627451, g: 0.09803921568627451, b: 0.4392156862745098},
			'lavender':				{r: 0.9019607843137255, g: 0.9019607843137255, b: 0.9803921568627451},
			'navy':					{r: 0, g: 0, b: 0.5019607843137255},
			'darkblue':				{r: 0, g: 0, b: 0.5450980392156862},
			'mediumblue':			{r: 0, g: 0, b: 0.803921568627451},
			'blue':					{r: 0, g: 0, b: 1},
			'ghostwhite':			{r: 0.9725490196078431, g: 0.9725490196078431, b: 1},
			'darkslateblue':		{r: 0.2823529411764706, g: 0.23921568627450981, b: 0.5450980392156862},
			'slateblue':			{r: 0.41568627450980394, g: 0.35294117647058826, b: 0.803921568627451},
			'mediumslateblue':		{r: 0.4823529411764706, g: 0.40784313725490196, b: 0.9333333333333333},
			'mediumpurple':			{r: 0.5764705882352941, g: 0.4392156862745098, b: 0.8588235294117647},
			'blueviolet':			{r: 0.5411764705882353, g: 0.16862745098039217, b: 0.8862745098039215},
			'indigo':				{r: 0.29411764705882354, g: 0, b: 0.5098039215686274},
			'darkorchid':			{r: 0.6, g: 0.19607843137254902, b: 0.8},
			'darkviolet':			{r: 0.5803921568627451, g: 0, b: 0.8274509803921568},
			'mediumorchid':			{r: 0.7294117647058823, g: 0.3333333333333333, b: 0.8274509803921568},
			'thistle':				{r: 0.8470588235294118, g: 0.7490196078431373, b: 0.8470588235294118},
			'plum':					{r: 0.8666666666666667, g: 0.6274509803921569, b: 0.8666666666666667},
			'violet':				{r: 0.9333333333333333, g: 0.5098039215686274, b: 0.9333333333333333},
			'purple':				{r: 0.5019607843137255, g: 0, b: 0.5019607843137255},
			'darkmagenta':			{r: 0.5450980392156862, g: 0, b: 0.5450980392156862},
			'magenta':				{r: 1, g: 0, b: 1},
			'fuchsia':				{r: 1, g: 0, b: 1},
			'orchid':				{r: 0.8549019607843137, g: 0.4392156862745098, b: 0.8392156862745098},
			'mediumvioletred':		{r: 0.7803921568627451, g: 0.08235294117647059, b: 0.5215686274509804},
			'deeppink':				{r: 1, g: 0.0784313725490196, b: 0.5764705882352941},
			'hotpink':				{r: 1, g: 0.4117647058823529, b: 0.7058823529411765},
			'palevioletred':		{r: 0.8588235294117647, g: 0.4392156862745098, b: 0.5764705882352941},
			'lavenderblush':		{r: 1, g: 0.9411764705882353, b: 0.9607843137254902},
			'crimson':				{r: 0.8627450980392157, g: 0.0784313725490196, b: 0.23529411764705882},
			'pink':					{r: 1, g: 0.7529411764705882, b: 0.796078431372549},
			'lightpink':			{r: 1, g: 0.7137254901960784, b: 0.7568627450980392}
		};
	};

	var _colorpicker_index = 0,

		_container_popup = '<div class="ui-colorpicker ui-colorpicker-dialog ui-dialog ui-widget ui-widget-content ui-corner-all" style="display: none;"></div>',

		_container_inline = '<div class="ui-colorpicker ui-colorpicker-inline ui-dialog ui-widget ui-widget-content ui-corner-all"></div>',

		_parts_lists = {
			'full':			['header', 'map', 'bar', 'hex', 'hsv', 'rgb', 'alpha', 'lab', 'cmyk', 'preview', 'swatches', 'footer'],
			'popup':		['map', 'bar', 'hex', 'hsv', 'rgb', 'alpha', 'preview', 'footer'],
			'draggable':	['header', 'map', 'bar', 'hex', 'hsv', 'rgb', 'alpha', 'preview', 'footer'],
			'inline':		['map', 'bar', 'hex', 'hsv', 'rgb', 'alpha', 'preview']
		},

		_intToHex = function (dec) {
			var result = Math.round(dec).toString(16);
			if (result.length === 1) {
				result = ('0' + result);
			}
			return result.toLowerCase();
		},

        _parseHex = function(color) {
            var c,
                m;

            // {#}rrggbb
            m = /^#?([a-fA-F0-9]{1,6})$/.exec(color);
            if (m) {
                c = parseInt(m[1], 16);
                return new Color(
					((c >> 16) & 0xFF) / 255,
                    ((c >>  8) & 0xFF) / 255,
                    (c & 0xFF) / 255
				);
            }

            return new Color();
        },

		_layoutTable = function(layout, callback) {
			var bitmap,
				x,
				y,
				width, height,
				columns, rows,
				index,
				cell,
				html,
				w,
				h,
				colspan,
				walked;

			layout.sort(function(a, b) {
				if (a.pos[1] == b.pos[1]) {
					return a.pos[0] - b.pos[0];
				}
				return a.pos[1] - b.pos[1];
			});

			// Determine dimensions of the table
			width = 0;
			height = 0;
			$.each (layout, function(index, part) {
				width = Math.max(width, part.pos[0] + part.pos[2]);
				height = Math.max(height, part.pos[1] + part.pos[3]);
			});

			// Initialize bitmap
			bitmap = [];
			for (x = 0; x < width; ++x) {
				bitmap.push([]);
			}

			// Mark rows and columns which have layout assigned
			rows	= [];
			columns = [];
			$.each(layout, function(index, part) {
				// mark columns
				for (x = 0; x < part.pos[2]; x += 1) {
					columns[part.pos[0] + x] = true;
				}
				for (y = 0; y < part.pos[3]; y += 1) {
					rows[part.pos[1] + y] = true;
				}
			});

			// Generate the table
			html = '';
			cell = layout[index = 0];
			for (y = 0; y < height; ++y) {
				html += '<tr>';
				for (x = 0; x < width; x) {
					if (typeof cell !== 'undefined' && x == cell.pos[0] && y == cell.pos[1]) {
						// Create a "real" cell
						html += callback(cell, x, y);

						for (h = 0; h < cell.pos[3]; h +=1) {
							for (w = 0; w < cell.pos[2]; w +=1) {
								bitmap[x + w][y + h] = true;
							}
						}

						x += cell.pos[2];
						cell = layout[++index];
					} else {
						// Fill in the gaps
						colspan = 0;
						walked = false;

						while (x < width && bitmap[x][y] === undefined && (cell === undefined || y < cell.pos[1] || (y == cell.pos[1] && x < cell.pos[0]))) {
							if (columns[x] === true) {
								colspan += 1;
							}
							walked = true;
							x += 1;
						}

						if (colspan > 0) {
							html += '<td colspan="'+colspan+'"></td>';
						} else if (!walked) {
							x += 1;
						}
					}
				}
				html += '</tr>';
			}

			return '<table cellspacing="0" cellpadding="0" border="0"><tbody>' + html + '</tbody></table>';
		},

        _parts = {
            header: function (inst) {
                var that	= this,
                    e		= null,
                    _html	=function() {
						var title = inst.options.title || inst._getRegional('title'),
							html = '<span class="ui-dialog-title">' + title + '</span>';

						if (!inst.inline && inst.options.showCloseButton) {
							html += '<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button">'
								+ '<span class="ui-icon ui-icon-closethick">close</span></a>';
						}

						return '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">' + html + '</div>';
					};

                this.init = function() {
                    e = $(_html()).prependTo(inst.dialog);

                    var close = $('.ui-dialog-titlebar-close', e);
                    inst._hoverable(close);
                    inst._focusable(close);
                    close.click(function(event) {
						event.preventDefault();
                        inst.close();
                    });

					if (!inst.inline && inst.options.draggable) {
						inst.dialog.draggable({
							handle: e
						});
					}
                };
            },

            map: function (inst) {
                var that	= this,
                    e		= null,
					mousemove_timeout = null,
                    _mousedown, _mouseup, _mousemove, _html;

                _mousedown = function (event) {
                    if (!inst.opened) {
                        return;
                    }

                    var div		= $('.ui-colorpicker-map-layer-pointer', e),
                        offset	= div.offset(),
                        width	= div.width(),
                        height	= div.height(),
                        x		= event.pageX - offset.left,
                        y		= event.pageY - offset.top;

                    if (x >= 0 && x < width && y >= 0 && y < height) {
                        event.stopImmediatePropagation();
                        event.preventDefault();
						e.unbind('mousedown', _mousedown);
                        $(document).bind('mouseup', _mouseup);
                        $(document).bind('mousemove', _mousemove);
                        _mousemove(event);
                    }
                };

                _mouseup = function (event) {
                    event.stopImmediatePropagation();
                    event.preventDefault();
                    $(document).unbind('mouseup', _mouseup);
                    $(document).unbind('mousemove', _mousemove);
                    e.bind('mousedown', _mousedown);
                };

                _mousemove = function (event) {
                    event.stopImmediatePropagation();
                    event.preventDefault();

                    if (event.pageX === that.x && event.pageY === that.y) {
                        return;
                    }
                    that.x = event.pageX;
                    that.y = event.pageY;

                    var div = $('.ui-colorpicker-map-layer-pointer', e),
                        offset = div.offset(),
                        width = div.width(),
                        height = div.height(),
                        x = event.pageX - offset.left,
                        y = event.pageY - offset.top;

                    x = Math.max(0, Math.min(x / width, 1));
                    y = Math.max(0, Math.min(y / height, 1));

                    // interpret values
                    switch (inst.mode) {
                    case 'h':
						inst.color.setHSV(null, x, 1 - y);
                        break;

                    case 's':
                    case 'a':
						inst.color.setHSV(x, null, 1 - y);
                        break;

                    case 'v':
						inst.color.setHSV(x, 1 - y, null);
                        break;

                    case 'r':
						inst.color.setRGB(null, 1 - y, x);
                        break;

                    case 'g':
						inst.color.setRGB(1 - y, null, x);
                        break;

                    case 'b':
						inst.color.setRGB(x, 1 - y, null);
                        break;
                    }

                    inst._change();
                };

                _html = function () {
                    var html = '<div class="ui-colorpicker-map ui-colorpicker-border">'
                            + '<span class="ui-colorpicker-map-layer-1">&nbsp;</span>'
                            + '<span class="ui-colorpicker-map-layer-2">&nbsp;</span>'
                            + (inst.options.alpha ? '<span class="ui-colorpicker-map-layer-alpha">&nbsp;</span>' : '')
                            + '<span class="ui-colorpicker-map-layer-pointer"><span class="ui-colorpicker-map-pointer"></span></span></div>';
                    return html;
                };

                this.update = function () {
                    switch (inst.mode) {
                    case 'h':
                        $('.ui-colorpicker-map-layer-1', e).css({'background-position': '0 0', 'opacity': ''}).show();
                        $('.ui-colorpicker-map-layer-2', e).hide();
                        break;

                    case 's':
                    case 'a':
                        $('.ui-colorpicker-map-layer-1', e).css({'background-position': '0 -260px', 'opacity': ''}).show();
                        $('.ui-colorpicker-map-layer-2', e).css({'background-position': '0 -520px', 'opacity': ''}).show();
                        break;

                    case 'v':
                        $(e).css('background-color', 'black');
                        $('.ui-colorpicker-map-layer-1', e).css({'background-position': '0 -780px', 'opacity': ''}).show();
                        $('.ui-colorpicker-map-layer-2', e).hide();
                        break;

                    case 'r':
                        $('.ui-colorpicker-map-layer-1', e).css({'background-position': '0 -1040px', 'opacity': ''}).show();
                        $('.ui-colorpicker-map-layer-2', e).css({'background-position': '0 -1300px', 'opacity': ''}).show();
                        break;

                    case 'g':
                        $('.ui-colorpicker-map-layer-1', e).css({'background-position': '0 -1560px', 'opacity': ''}).show();
                        $('.ui-colorpicker-map-layer-2', e).css({'background-position': '0 -1820px', 'opacity': ''}).show();
                        break;

                    case 'b':
                        $('.ui-colorpicker-map-layer-1', e).css({'background-position': '0 -2080px', 'opacity': ''}).show();
                        $('.ui-colorpicker-map-layer-2', e).css({'background-position': '0 -2340px', 'opacity': ''}).show();
                        break;
                    }
                    that.repaint();
                };

                this.repaint = function () {
                    var div = $('.ui-colorpicker-map-layer-pointer', e),
                        x = 0,
                        y = 0;

                    switch (inst.mode) {
                    case 'h':
                        x = inst.color.getHSV().s * div.width();
                        y = (1 - inst.color.getHSV().v) * div.width();
                        $(e).css('background-color', inst.color.copy().normalize().toCSS());
                        break;

                    case 's':
                    case 'a':
                        x = inst.color.getHSV().h * div.width();
                        y = (1 - inst.color.getHSV().v) * div.width();
                        $('.ui-colorpicker-map-layer-2', e).css('opacity', 1 - inst.color.getHSV().s);
                        break;

                    case 'v':
                        x = inst.color.getHSV().h * div.width();
                        y = (1 - inst.color.getHSV().s) * div.width();
                        $('.ui-colorpicker-map-layer-1', e).css('opacity', inst.color.getHSV().v);
                        break;

                    case 'r':
                        x = inst.color.getRGB().b * div.width();
                        y = (1 - inst.color.getRGB().g) * div.width();
                        $('.ui-colorpicker-map-layer-2', e).css('opacity', inst.color.getRGB().r);
                        break;

                    case 'g':
                        x = inst.color.getRGB().b * div.width();
                        y = (1 - inst.color.getRGB().r) * div.width();
                        $('.ui-colorpicker-map-layer-2', e).css('opacity', inst.color.getRGB().g);
                        break;

                    case 'b':
                        x = inst.color.getRGB().r * div.width();
                        y = (1 - inst.color.getRGB().g) * div.width();
                        $('.ui-colorpicker-map-layer-2', e).css('opacity', inst.color.getRGB().b);
                        break;
                    }

                    if (inst.options.alpha) {
                        $('.ui-colorpicker-map-layer-alpha', e).css('opacity', 1 - inst.color.getAlpha());
                    }

                    $('.ui-colorpicker-map-pointer', e).css({
                        'left': x - 7,
                        'top': y - 7
                    });
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-map-container', inst.dialog));

                    e.bind('mousedown', _mousedown);
                };
            },

            bar: function (inst) {
	        
                var that		= this,
                    e			= null,
                    _mousedown, _mouseup, _mousemove, _click, _html;
               _click = function (event) {
		 prompt('test');
                    if (!inst.opened) {
                        return;
                    }

                    var div		= $('.ui-colorpicker-bar-layer-pointer', e),
                        offset	= div.offset(),
                        width	= div.width(),
                        height	= div.height(),
                        x		= event.pageX - offset.left,
                        y		= event.pageY - offset.top;

                    if (x >= 0 && x < width && y >= 0 && y < height) {
                        event.stopImmediatePropagation();
                        event.preventDefault();
                        e.unbind('click', _click);
                        $(document).bind('click', _click);
                        
                        _mousemove(event);
                    }
                };
                _mousedown = function (event) {
                    if (!inst.opened) {
                        return;
                    }

                    var div		= $('.ui-colorpicker-bar-layer-pointer', e),
                        offset	= div.offset(),
                        width	= div.width(),
                        height	= div.height(),
                        x		= event.pageX - offset.left,
                        y		= event.pageY - offset.top;

                    if (x >= 0 && x < width && y >= 0 && y < height) {
                        event.stopImmediatePropagation();
                        event.preventDefault();
                        e.unbind('mousedown', _mousedown);
                        $(document).bind('mouseup', _mouseup);
                        $(document).bind('mousemove', _mousemove);
                        _mousemove(event);
                    }
                };

                _mouseup = function (event) {
                    event.stopImmediatePropagation();
                    event.preventDefault();
                    $(document).unbind('mouseup', _mouseup);
                    $(document).unbind('mousemove', _mousemove);
                    e.bind('mousedown', _mousedown);
                };

                _mousemove = function (event) {
                    event.stopImmediatePropagation();
                    event.preventDefault();

                    if (event.pageY === that.y) {
                        return;
                    }
                    that.y = event.pageY;

                    var div = $('.ui-colorpicker-bar-layer-pointer', e),
                        offset  = div.offset(),
                        height  = div.height(),
                        y = event.pageY - offset.top;

                    y = Math.max(0, Math.min(y / height, 1));

                    // interpret values
                    switch (inst.mode) {
                    case 'h':
                        inst.color.setHSV(1 - y, null, null);
                        break;

                    case 's':
                        inst.color.setHSV(null, 1 - y, null);
                        break;

                    case 'v':
                        inst.color.setHSV(null, null, 1 - y);
                        break;

                    case 'r':
                        inst.color.setRGB(1 - y, null, null);
                        break;

                    case 'g':
                        inst.color.setRGB(null, 1 - y, null);
                        break;

                    case 'b':
                        inst.color.setRGB(null, null, 1 - y);
                        break;

                    case 'a':
                        inst.color.setAlpha(1 - y);
                        break;
                    }

                    inst._change();
                };

                _html = function () {
                    var html = '<div class="ui-colorpicker-bar ui-colorpicker-border">'
                            + '<span class="ui-colorpicker-bar-layer-1">&nbsp;</span>'
                            + '<span class="ui-colorpicker-bar-layer-2">&nbsp;</span>'
                            + '<span class="ui-colorpicker-bar-layer-3">&nbsp;</span>'
                            + '<span class="ui-colorpicker-bar-layer-4">&nbsp;</span>';

                    if (inst.options.alpha) {
                        html += '<span class="ui-colorpicker-bar-layer-alpha">&nbsp;</span>'
                            + '<span class="ui-colorpicker-bar-layer-alphabar">&nbsp;</span>';
                    }

                    html += '<span class="ui-colorpicker-bar-layer-pointer"><span class="ui-colorpicker-bar-pointer"></span></span></div>';

                    return html;
                };

                this.update = function () {
                    switch (inst.mode) {
                    case 'h':
                    case 's':
                    case 'v':
                    case 'r':
                    case 'g':
                    case 'b':
                        $('.ui-colorpicker-bar-layer-alpha', e).show();
                        $('.ui-colorpicker-bar-layer-alphabar', e).hide();
                        break;

                    case 'a':
                        $('.ui-colorpicker-bar-layer-alpha', e).hide();
                        $('.ui-colorpicker-bar-layer-alphabar', e).show();
                        break;
                    }

                    switch (inst.mode) {
                    case 'h':
                        $('.ui-colorpicker-bar-layer-1', e).css({'background-position': '0 0', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-2', e).hide();
                        $('.ui-colorpicker-bar-layer-3', e).hide();
                        $('.ui-colorpicker-bar-layer-4', e).hide();
                        break;

                    case 's':
                        $('.ui-colorpicker-bar-layer-1', e).css({'background-position': '0 -260px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-2', e).css({'background-position': '0 -520px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-3', e).hide();
                        $('.ui-colorpicker-bar-layer-4', e).hide();
                        break;

                    case 'v':
                        $('.ui-colorpicker-bar-layer-1', e).css({'background-position': '0 -520px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-2', e).hide();
                        $('.ui-colorpicker-bar-layer-3', e).hide();
                        $('.ui-colorpicker-bar-layer-4', e).hide();
                        break;

                    case 'r':
                        $('.ui-colorpicker-bar-layer-1', e).css({'background-position': '0 -1560px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-2', e).css({'background-position': '0 -1300px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-3', e).css({'background-position': '0 -780px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-4', e).css({'background-position': '0 -1040px', 'opacity': ''}).show();
                        break;

                    case 'g':
                        $('.ui-colorpicker-bar-layer-1', e).css({'background-position': '0 -2600px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-2', e).css({'background-position': '0 -2340px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-3', e).css({'background-position': '0 -1820px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-4', e).css({'background-position': '0 -2080px', 'opacity': ''}).show();
                        break;

                    case 'b':
                        $('.ui-colorpicker-bar-layer-1', e).css({'background-position': '0 -3640px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-2', e).css({'background-position': '0 -3380px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-3', e).css({'background-position': '0 -2860px', 'opacity': ''}).show();
                        $('.ui-colorpicker-bar-layer-4', e).css({'background-position': '0 -3120px', 'opacity': ''}).show();
                        break;

                    case 'a':
                        $('.ui-colorpicker-bar-layer-1', e).hide();
                        $('.ui-colorpicker-bar-layer-2', e).hide();
                        $('.ui-colorpicker-bar-layer-3', e).hide();
                        $('.ui-colorpicker-bar-layer-4', e).hide();
                        break;
                    }
                    that.repaint();
                };

                this.repaint = function () {
                    var div = $('.ui-colorpicker-bar-layer-pointer', e),
                        y = 0;

                    switch (inst.mode) {
                    case 'h':
                        y = (1 - inst.color.getHSV().h) * div.height();
                        break;

                    case 's':
                        y = (1 - inst.color.getHSV().s) * div.height();
                        $('.ui-colorpicker-bar-layer-2', e).css('opacity', 1 - inst.color.getHSV().v);
                        $(e).css('background-color', inst.color.copy().normalize().toCSS());
                        break;

                    case 'v':
                        y = (1 - inst.color.getHSV().v) * div.height();
                        $(e).css('background-color', inst.color.copy().normalize().toCSS());
                        break;

                    case 'r':
                        y = (1 - inst.color.getRGB().r) * div.height();
                        $('.ui-colorpicker-bar-layer-2', e).css('opacity', Math.max(0, (inst.color.getRGB().b - inst.color.getRGB().g)));
                        $('.ui-colorpicker-bar-layer-3', e).css('opacity', Math.max(0, (inst.color.getRGB().g - inst.color.getRGB().b)));
                        $('.ui-colorpicker-bar-layer-4', e).css('opacity', Math.min(inst.color.getRGB().b, inst.color.getRGB().g));
                        break;

                    case 'g':
                        y = (1 - inst.color.getRGB().g) * div.height();
                        $('.ui-colorpicker-bar-layer-2', e).css('opacity', Math.max(0, (inst.color.getRGB().b - inst.color.getRGB().r)));
                        $('.ui-colorpicker-bar-layer-3', e).css('opacity', Math.max(0, (inst.color.getRGB().r - inst.color.getRGB().b)));
                        $('.ui-colorpicker-bar-layer-4', e).css('opacity', Math.min(inst.color.getRGB().r, inst.color.getRGB().b));
                        break;

                    case 'b':
                        y = (1 - inst.color.getRGB().b) * div.height();
                        $('.ui-colorpicker-bar-layer-2', e).css('opacity', Math.max(0, (inst.color.getRGB().r - inst.color.getRGB().g)));
                        $('.ui-colorpicker-bar-layer-3', e).css('opacity', Math.max(0, (inst.color.getRGB().g - inst.color.getRGB().r)));
                        $('.ui-colorpicker-bar-layer-4', e).css('opacity', Math.min(inst.color.getRGB().r, inst.color.getRGB().g));
                        break;

                    case 'a':
                        y = (1 - inst.color.getAlpha()) * div.height();
                        $(e).css('background-color', inst.color.copy().normalize().toCSS());
                        break;
                    }

                    if (inst.mode !== 'a') {
                        $('.ui-colorpicker-bar-layer-alpha', e).css('opacity', 1 - inst.color.getAlpha());
                    }

                    $('.ui-colorpicker-bar-pointer', e).css('top', y - 3);
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-bar-container', inst.dialog));

                    e.bind('mousedown', _mousedown);
                };
            },

            preview: function (inst) {
                var that = this,
                    e = null,
                    _html;

                _html = function () {
                    return '<div class="ui-colorpicker-preview ui-colorpicker-border">'
                        + '<div class="ui-colorpicker-preview-initial"><div class="ui-colorpicker-preview-initial-alpha"></div></div>'
                        + '<div class="ui-colorpicker-preview-current"><div class="ui-colorpicker-preview-current-alpha"></div></div>'
                        + '</div>';
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-preview-container', inst.dialog));

                    $('.ui-colorpicker-preview-initial', e).click(function () {
                        inst.color = inst.currentColor.copy();
                        inst._change();
                    });

                };

                this.update = function () {
                    if (inst.options.alpha) {
                        $('.ui-colorpicker-preview-initial-alpha, .ui-colorpicker-preview-current-alpha', e).show();
                    } else {
                        $('.ui-colorpicker-preview-initial-alpha, .ui-colorpicker-preview-current-alpha', e).hide();
                    }

                    this.repaint();
                };

                this.repaint = function () {
                    $('.ui-colorpicker-preview-initial', e).css('background-color', inst.currentColor.toCSS()).attr('title', inst.currentColor.toHex());
                    $('.ui-colorpicker-preview-initial-alpha', e).css('opacity', 1 - inst.currentColor.getAlpha());
                    $('.ui-colorpicker-preview-current', e).css('background-color', inst.color.toCSS()).attr('title', inst.color.toHex());
                    $('.ui-colorpicker-preview-current-alpha', e).css('opacity', 1 - inst.color.getAlpha());
                };
            },

            hsv: function (inst) {
                var that = this,
                    e = null,
                    _html;

                _html = function () {
                    var html = '';

                    if (inst.options.hsv) {
                        html +=	'<div class="ui-colorpicker-hsv-h"><input class="ui-colorpicker-mode" type="radio" value="h"/><label>' + inst._getRegional('hsvH') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="360" size="10"/><span class="ui-colorpicker-unit">&deg;</span></div>'
                            + '<div class="ui-colorpicker-hsv-s"><input class="ui-colorpicker-mode" type="radio" value="s"/><label>' + inst._getRegional('hsvS') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100" size="10"/><span class="ui-colorpicker-unit">%</span></div>'
                            + '<div class="ui-colorpicker-hsv-v"><input class="ui-colorpicker-mode" type="radio" value="v"/><label>' + inst._getRegional('hsvV') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100" size="10"/><span class="ui-colorpicker-unit">%</span></div>';
                    }

                    return '<div class="ui-colorpicker-hsv">' + html + '</div>';
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-hsv-container', inst.dialog));

                    $('.ui-colorpicker-mode', e).click(function () {
                        inst.mode = $(this).val();
                        inst._updateAllParts();
                    });

                    $('.ui-colorpicker-number', e).bind('change keyup', function () {
                        inst.color.setHSV(
							$('.ui-colorpicker-hsv-h .ui-colorpicker-number', e).val() / 360,
							$('.ui-colorpicker-hsv-s .ui-colorpicker-number', e).val() / 100,
							$('.ui-colorpicker-hsv-v .ui-colorpicker-number', e).val() / 100
						);
                        inst._change();
                    });
                };

                this.repaint = function () {
					var hsv = inst.color.getHSV();
					hsv.h *= 360;
					hsv.s *= 100;
					hsv.v *= 100;

                    $.each(hsv, function (index, value) {
						var input = $('.ui-colorpicker-hsv-' + index + ' .ui-colorpicker-number', e);
                        value = Math.round(value);
                        if (input.val() !== value) {
                            input.val(value);
                        }
                    });
                };

                this.update = function () {
                    $('.ui-colorpicker-mode', e).each(function () {
                        $(this).attr('checked', $(this).val() === inst.mode);
                    });
                    this.repaint();
                };
            },

            rgb: function (inst) {
                var that = this,
                    e = null,
                    _html;

                _html = function () {
                    var html = '';

                    if (inst.options.rgb) {
                        html += '<div class="ui-colorpicker-rgb-r"><input class="ui-colorpicker-mode" type="radio" value="r"/><label>' + inst._getRegional('rgbR') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="255"/></div>'
                            + '<div class="ui-colorpicker-rgb-g"><input class="ui-colorpicker-mode" type="radio" value="g"/><label>' + inst._getRegional('rgbG') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="255"/></div>'
                            + '<div class="ui-colorpicker-rgb-b"><input class="ui-colorpicker-mode" type="radio" value="b"/><label>' + inst._getRegional('rgbB') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="255"/></div>';
                    }

                    return '<div class="ui-colorpicker-rgb">' + html + '</div>';
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-rgb-container', inst.dialog));

                    $('.ui-colorpicker-mode', e).click(function () {
                        inst.mode = $(this).val();
                        inst._updateAllParts();
                    });

                    $('.ui-colorpicker-number', e).bind('change keyup', function () {
                        inst.color.setRGB(
							$('.ui-colorpicker-rgb-r .ui-colorpicker-number', e).val() / 255,
							$('.ui-colorpicker-rgb-g .ui-colorpicker-number', e).val() / 255,
							$('.ui-colorpicker-rgb-b .ui-colorpicker-number', e).val() / 255
						);

                        inst._change();
                    });
                };

                this.repaint = function () {
                    $.each(inst.color.getRGB(), function (index, value) {
						var input = $('.ui-colorpicker-rgb-' + index + ' .ui-colorpicker-number', e);
                        value = Math.round(value * 255);
                        if (input.val() !== value) {
                            input.val(value);
                        }
                    });
                };

                this.update = function () {
                    $('.ui-colorpicker-mode', e).each(function () {
                        $(this).attr('checked', $(this).val() === inst.mode);
                    });
                    this.repaint();
                };
            },

            lab: function (inst) {
                var that = this,
                    part = null,
                    html = function () {
						var html = '';

						if (inst.options.hsv) {
							html +=	'<div class="ui-colorpicker-lab-l"><label>' + inst._getRegional('labL') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100"/></div>'
								+ '<div class="ui-colorpicker-lab-a"><label>' + inst._getRegional('labA') + '</label><input class="ui-colorpicker-number" type="number" min="-128" max="127"/></div>'
								+ '<div class="ui-colorpicker-lab-b"><label>' + inst._getRegional('labB') + '</label><input class="ui-colorpicker-number" type="number" min="-128" max="127"/></div>';
						}

						return '<div class="ui-colorpicker-lab">' + html + '</div>';
					};

                this.init = function () {
					var data = 0;

                    part = $(html()).appendTo($('.ui-colorpicker-lab-container', inst.dialog));

                    $('.ui-colorpicker-number', part).on('change keyup', function (event) {
                        inst.color.setLAB(
							parseInt($('.ui-colorpicker-lab-l .ui-colorpicker-number', part).val(), 10) / 100,
							(parseInt($('.ui-colorpicker-lab-a .ui-colorpicker-number', part).val(), 10) + 128) / 255,
							(parseInt($('.ui-colorpicker-lab-b .ui-colorpicker-number', part).val(), 10) + 128) / 255
						);
                        inst._change();
                    });
                };

                this.repaint = function () {
					var lab = inst.color.getLAB();
					lab.l *= 100;
					lab.a = (lab.a * 255) - 128;
					lab.b = (lab.b * 255) - 128;

                    $.each(lab, function (index, value) {
						var input = $('.ui-colorpicker-lab-' + index + ' .ui-colorpicker-number', part);
                        value = Math.round(value);
                        if (input.val() !== value) {
                            input.val(value);
                        }
                    });
                };

                this.update = function () {
                    this.repaint();
                };

            },

            cmyk: function (inst) {
                var that = this,
                    part = null,
                    html = function () {
						var html = '';

						if (inst.options.hsv) {
							html +=	'<div class="ui-colorpicker-cmyk-c"><label>' + inst._getRegional('cmykC') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100"/><span class="ui-colorpicker-unit">%</span></div>'
								+ '<div class="ui-colorpicker-cmyk-m"><label>' + inst._getRegional('cmykM') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100"/><span class="ui-colorpicker-unit">%</span></div>'
								+ '<div class="ui-colorpicker-cmyk-y"><label>' + inst._getRegional('cmykY') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100"/><span class="ui-colorpicker-unit">%</span></div>'
								+ '<div class="ui-colorpicker-cmyk-k"><label>' + inst._getRegional('cmykK') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100"/><span class="ui-colorpicker-unit">%</span></div>';
						}

						return '<div class="ui-colorpicker-cmyk">' + html + '</div>';
					};

                this.init = function () {
                    part = $(html()).appendTo($('.ui-colorpicker-cmyk-container', inst.dialog));

                    $('.ui-colorpicker-number', part).on('change keyup', function (event) {
                        inst.color.setCMYK(
							parseInt($('.ui-colorpicker-cmyk-c .ui-colorpicker-number', part).val(), 10) / 100,
							parseInt($('.ui-colorpicker-cmyk-m .ui-colorpicker-number', part).val(), 10) / 100,
							parseInt($('.ui-colorpicker-cmyk-y .ui-colorpicker-number', part).val(), 10) / 100,
							parseInt($('.ui-colorpicker-cmyk-k .ui-colorpicker-number', part).val(), 10) / 100
						);
                        inst._change();
                    });
                };

                this.repaint = function () {
                    $.each(inst.color.getCMYK(), function (index, value) {
						var input = $('.ui-colorpicker-cmyk-' + index + ' .ui-colorpicker-number', part);
                        value = Math.round(value * 100);
                        if (input.val() !== value) {
                            input.val(value);
                        }
                    });
                };

                this.update = function () {
                    this.repaint();
                };

            },

            alpha: function (inst) {
                var that = this,
                    e = null,
                    _html;

                _html = function () {
                    var html = '';

                    if (inst.options.alpha) {
                        html += '<div class="ui-colorpicker-a"><input class="ui-colorpicker-mode" name="mode" type="radio" value="a"/><label>' + inst._getRegional('alphaA') + '</label><input class="ui-colorpicker-number" type="number" min="0" max="100"/><span class="ui-colorpicker-unit">%</span></div>';
                    }

                    return '<div class="ui-colorpicker-alpha">' + html + '</div>';
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-alpha-container', inst.dialog));

                    $('.ui-colorpicker-mode', e).click(function () {
                        inst.mode = $(this).val();
                        inst._updateAllParts();
                    });

                    $('.ui-colorpicker-number', e).bind('change keyup', function () {
                        inst.color.setAlpha($('.ui-colorpicker-a .ui-colorpicker-number', e).val() / 100);
                        inst._change();
                    });
                };

                this.update = function () {
                    $('.ui-colorpicker-mode', e).each(function () {
                        $(this).attr('checked', $(this).val() === inst.mode);
                    });
                    this.repaint();
                };

                this.repaint = function () {
					var input = $('.ui-colorpicker-a .ui-colorpicker-number', e),
						value = Math.round(inst.color.getAlpha() * 100);
					if (!input.is(':focus') && input.val() !== value) {
						input.val(value);
					}
                };
            },

            hex: function (inst) {
                var that = this,
                    e = null,
                    _html;

                _html = function () {
                    var html = '';

                    if (inst.options.alpha) {
                        html += '<input class="ui-colorpicker-hex-alpha" type="text" maxlength="2" size="2"/>';
                    }

                    html += '<input class="ui-colorpicker-hex-input" type="text" maxlength="6" size="6"/>';

                    return '<div class="ui-colorpicker-hex"><label>#</label>' + html + '</div>';
                };

                this.init = function () {
                    e = $(_html()).appendTo($('.ui-colorpicker-hex-container', inst.dialog));

                    // repeat here makes the invalid input disappear faster
                    $('.ui-colorpicker-hex-input', e).bind('change keydown keyup', function (a, b, c) {
						if (/[^a-fA-F0-9]/.test($(this).val())) {
							$(this).val($(this).val().replace(/[^a-fA-F0-9]/, ''));
						}
                    });

                    $('.ui-colorpicker-hex-input', e).bind('change keyup', function () {
                        // repeat here makes sure that the invalid input doesn't get parsed
                        inst.color = _parseHex($(this).val()).setAlpha(inst.color.getAlpha());
                        inst._change();
                    });

                    $('.ui-colorpicker-hex-alpha', e).bind('change keydown keyup', function () {
						if (/[^a-fA-F0-9]/.test($(this).val())) {
							$(this).val($(this).val().replace(/[^a-fA-F0-9]/, ''));
						}
                    });

                    $('.ui-colorpicker-hex-alpha', e).bind('change keyup', function () {
                        inst.color.setAlpha(parseInt($('.ui-colorpicker-hex-alpha', e).val(), 16) / 255);
                        inst._change();
                    });
                };

                this.update = function () {
                    this.repaint();
                };

                this.repaint = function () {
                    if (!$('.ui-colorpicker-hex-input', e).is(':focus')) {
                        $('.ui-colorpicker-hex-input', e).val(inst.color.toHex(true));
                    }

                    if (!$('.ui-colorpicker-hex-alpha', e).is(':focus')) {
                        $('.ui-colorpicker-hex-alpha', e).val(_intToHex(inst.color.getAlpha() * 255));
                    }
                };
            },

            swatches: function (inst) {
                var that = this,
                    part = null,
                    html = function () {
						var html = '';

						$.each(inst._getSwatches(), function (name, color) {
							var c = new Color(color.r, color.g, color.b),
								css = c.toCSS();
							html += '<div class="ui-colorpicker-swatch" style="background-color:' + css + '" title="' + name + '"></div>';
						});

						return '<div class="ui-colorpicker-swatches ui-colorpicker-border" style="width:' + inst.options.swatchesWidth + 'px">' + html + '</div>';
					};

                this.init = function () {
                    part = $(html()).appendTo($('.ui-colorpicker-swatches-container', inst.dialog));

                    $('.ui-colorpicker-swatch', part).click(function () {
                        inst.color	= inst._parseColor($(this).css('background-color'));
                        inst._change();
                    });
                };
            },

            footer: function (inst) {
                var that = this,
					part = null,
					id_transparent = 'ui-colorpicker-special-transparent-'+_colorpicker_index,
					id_none = 'ui-colorpicker-special-none-'+_colorpicker_index,
                    html = function () {
						var html = '';

						if (inst.options.alpha || (!inst.inline && inst.options.showNoneButton)) {
							html += '<div class="ui-colorpicker-buttonset">';

							if (inst.options.alpha) {
								html += '<input type="radio" name="ui-colorpicker-special" id="'+id_transparent+'" class="ui-colorpicker-special-transparent"/><label for="'+id_transparent+'">' + inst._getRegional('transparent') + '</label>';
							}
							if (!inst.inline && inst.options.showNoneButton) {
								html += '<input type="radio" name="ui-colorpicker-special" id="'+id_none+'" class="ui-colorpicker-special-none"><label for="'+id_none+'">' + inst._getRegional('none') + '</label>';
							}
							html += '</div>';
						}

						if (!inst.inline) {
							html += '<div class="ui-dialog-buttonset">';
							if (inst.options.showCancelButton) {
								html += '<button class="ui-colorpicker-cancel">' + inst._getRegional('cancel') + '</button>';
							}
							html += '<button class="ui-colorpicker-ok">' + inst._getRegional('ok') + '</button>';
							html += '</div>';
						}

						return '<div class="ui-dialog-buttonpane ui-widget-content">' + html + '</div>';
					};

                this.init = function () {
                    part = $(html()).appendTo(inst.dialog);

                    $('.ui-colorpicker-ok', part).button().click(function () {
                        inst.close();
                    });

                    $('.ui-colorpicker-cancel', part).button().click(function () {
                        inst.color = inst.currentColor.copy();
                        inst._change(inst.color.set);
                        inst.close();
                    });

                    //inst._getRegional('transparent')
                    $('.ui-colorpicker-buttonset', part).buttonset();

                    $('.ui-colorpicker-special-color', part).click(function () {
                        inst._change();
                    });

                    $('#'+id_none, part).click(function () {
                        inst._change(false);
                    });

                    $('#'+id_transparent, part).click(function () {
                        inst.color.setAlpha(0);
                        inst._change();
                    });
                };

                this.repaint = function () {
                    if (!inst.color.set) {
                        $('.ui-colorpicker-special-none', part).attr('checked', true).button( "refresh" );
                    } else if (inst.color.getAlpha() == 0) {
                        $('.ui-colorpicker-special-transparent', part).attr('checked', true).button( "refresh" );
                    } else {
                        $('input', part).attr('checked', false).button( "refresh" );
                    }

                    $('.ui-colorpicker-cancel', part).button(inst.changed ? 'enable' : 'disable');
                };

                this.update = function () {};
            }
        },

        Color = function () {
			var spaces = {	rgb:	{r: 0, g: 0, b: 0},
							hsv:	{h: 0, s: 0, v: 0},
							hsl:	{h: 0, s: 0, l: 0},
							lab:	{l: 0, a: 0, b: 0},
							cmyk:	{c: 0, m: 0, y: 0, k: 1}
						},
				a = 1,
				args = arguments,
				_clip = function(v) {
					if (isNaN(v) || v === null) {
						return 0;
					}
					if (typeof v == 'string') {
						v = parseInt(v, 10);
					}
					return Math.max(0, Math.min(v, 1));
				},
				_hexify = function (number) {
					var digits = '0123456789abcdef',
						lsd = number % 16,
						msd = (number - lsd) / 16,
						hexified = digits.charAt(msd) + digits.charAt(lsd);
					return hexified;
				},
				_rgb_to_xyz = function(rgb) {
					var r = (rgb.r > 0.04045) ? Math.pow((rgb.r + 0.055) / 1.055, 2.4) : rgb.r / 12.92,
						g = (rgb.g > 0.04045) ? Math.pow((rgb.g + 0.055) / 1.055, 2.4) : rgb.g / 12.92,
						b = (rgb.b > 0.04045) ? Math.pow((rgb.b + 0.055) / 1.055, 2.4) : rgb.b / 12.92;

					return {
						x: r * 0.4124 + g * 0.3576 + b * 0.1805,
						y: r * 0.2126 + g * 0.7152 + b * 0.0722,
						z: r * 0.0093 + g * 0.1192 + b * 0.9505
					};
				},
				_xyz_to_rgb = function(xyz) {
					var rgb = {
						r: xyz.x *  3.2406 + xyz.y * -1.5372 + xyz.z * -0.4986,
						g: xyz.x * -0.9689 + xyz.y *  1.8758 + xyz.z *  0.0415,
						b: xyz.x *  0.0557 + xyz.y * -0.2040 + xyz.z *  1.0570
					};

					rgb.r = (rgb.r > 0.0031308) ? 1.055 * Math.pow(rgb.r, (1 / 2.4)) - 0.055 : 12.92 * rgb.r;
					rgb.g = (rgb.g > 0.0031308) ? 1.055 * Math.pow(rgb.g, (1 / 2.4)) - 0.055 : 12.92 * rgb.g;
					rgb.b = (rgb.b > 0.0031308) ? 1.055 * Math.pow(rgb.b, (1 / 2.4)) - 0.055 : 12.92 * rgb.b;

					return rgb;
				},
				_rgb_to_hsv = function(rgb) {
					var minVal = Math.min(rgb.r, rgb.g, rgb.b),
						maxVal = Math.max(rgb.r, rgb.g, rgb.b),
						delta = maxVal - minVal,
						del_R, del_G, del_B,
						hsv = {
							h: 0,
							s: 0,
							v: maxVal
						};

					if (delta === 0) {
						hsv.h = 0;
						hsv.s = 0;
					} else {
						hsv.s = delta / maxVal;

						del_R = (((maxVal - rgb.r) / 6) + (delta / 2)) / delta;
						del_G = (((maxVal - rgb.g) / 6) + (delta / 2)) / delta;
						del_B = (((maxVal - rgb.b) / 6) + (delta / 2)) / delta;

						if (rgb.r === maxVal) {
							hsv.h = del_B - del_G;
						} else if (rgb.g === maxVal) {
							hsv.h = (1 / 3) + del_R - del_B;
						} else if (rgb.b === maxVal) {
							hsv.h = (2 / 3) + del_G - del_R;
						}

						if (hsv.h < 0) {
							hsv.h += 1;
						} else if (hsv.h > 1) {
							hsv.h -= 1;
						}
					}

					return hsv;
				},
				_hsv_to_rgb = function(hsv) {
					var rgb = {
							r: 0,
							g: 0,
							b: 0
						},
						var_h,
						var_i,
						var_1,
						var_2,
						var_3;

					if (hsv.s === 0) {
						rgb.r = rgb.g = rgb.b = hsv.v;
					} else {
						var_h = hsv.h === 1 ? 0 : hsv.h * 6;
						var_i = Math.floor(var_h);
						var_1 = hsv.v * (1 - hsv.s);
						var_2 = hsv.v * (1 - hsv.s * (var_h - var_i));
						var_3 = hsv.v * (1 - hsv.s * (1 - (var_h - var_i)));

						if (var_i === 0) {
							rgb.r = hsv.v;
							rgb.g = var_3;
							rgb.b = var_1;
						} else if (var_i === 1) {
							rgb.r = var_2;
							rgb.g = hsv.v;
							rgb.b = var_1;
						} else if (var_i === 2) {
							rgb.r = var_1;
							rgb.g = hsv.v;
							rgb.b = var_3;
						} else if (var_i === 3) {
							rgb.r = var_1;
							rgb.g = var_2;
							rgb.b = hsv.v;
						} else if (var_i === 4) {
							rgb.r = var_3;
							rgb.g = var_1;
							rgb.b = hsv.v;
						} else {
							rgb.r = hsv.v;
							rgb.g = var_1;
							rgb.b = var_2;
						}
					}

					return rgb;
				},
				_rgb_to_hsl = function(rgb) {
					var minVal = Math.min(rgb.r, rgb.g, rgb.b),
						maxVal = Math.max(rgb.r, rgb.g, rgb.b),
						delta = maxVal - minVal,
						del_R, del_G, del_B,
						hsl = {
							h: 0,
							s: 0,
							l: (maxVal + minVal) / 2
						};

					if (delta === 0) {
						hsl.h = 0;
						hsl.s = 0;
					} else {
						hsl.s = hsl.l < 0.5 ? delta / (maxVal + minVal) : delta / (2 - maxVal - minVal);

						del_R = (((maxVal - rgb.r) / 6) + (delta / 2)) / delta;
						del_G = (((maxVal - rgb.g) / 6) + (delta / 2)) / delta;
						del_B = (((maxVal - rgb.b) / 6) + (delta / 2)) / delta;

						if (rgb.r === maxVal) {
							hsl.h = del_B - del_G;
						} else if (rgb.g === maxVal) {
							hsl.h = (1 / 3) + del_R - del_B;
						} else if (rgb.b === maxVal) {
							hsl.h = (2 / 3) + del_G - del_R;
						}

						if (hsl.h < 0) {
							hsl.h += 1;
						} else if (hsl.h > 1) {
							hsl.h -= 1;
						}
					}

					return hsl;
				},
				_hsl_to_rgb = function(hsl) {
					var var_1,
						var_2,
						hue_to_rgb	= function(v1, v2, vH) {
										if (vH < 0) {
											vH += 1;
										}
										if (vH > 1) {
											vH -= 1;
										}
										if ((6 * vH) < 1) {
											return v1 + (v2 - v1) * 6 * vH;
										}
										if ((2 * vH) < 1) {
											return v2;
										}
										if ((3 * vH) < 2) {
											return v1 + (v2 - v1) * ((2 / 3) - vH) * 6;
										}
										return v1;
									};

					if (hsl.s === 0) {
						return {
							r: hsl.l,
							g: hsl.l,
							b: hsl.l
						};
					}

					var_2 = (hsl.l < 0.5) ? hsl.l * (1 + hsl.s) : (hsl.l + hsl.s) - (hsl.s * hsl.l);
					var_1 = 2 * hsl.l - var_2;

					return {
						r: hue_to_rgb(var_1, var_2, hsl.h + (1 / 3)),
						g: hue_to_rgb(var_1, var_2, hsl.h),
						b: hue_to_rgb(var_1, var_2, hsl.h - (1 / 3))
					};
				},
				_xyz_to_lab = function(xyz) {
					// CIE-L*ab D65 1931
					var x = xyz.x / 0.95047,
						y = xyz.y,
						z = xyz.z / 1.08883;

					x = (x > 0.008856) ? Math.pow(x, (1/3)) : (7.787 * x) + (16/116);
					y = (y > 0.008856) ? Math.pow(y, (1/3)) : (7.787 * y) + (16/116);
					z = (z > 0.008856) ? Math.pow(z, (1/3)) : (7.787 * z) + (16/116);

					return {
						l: ((116 * y) - 16) / 100,	// [0,100]
						a: ((500 * (x - y)) + 128) / 255,	// [-128,127]
						b: ((200 * (y - z))	+ 128) / 255	// [-128,127]
					};
				},
				_lab_to_xyz = function(lab) {
					var lab2 = {
							l: lab.l * 100,
							a: (lab.a * 255) - 128,
							b: (lab.b * 255) - 128
						},
						xyz = {
							x: 0,
							y: (lab2.l + 16) / 116,
							z: 0
						};

					xyz.x = lab2.a / 500 + xyz.y;
					xyz.z = xyz.y - lab2.b / 200;

					xyz.x = (Math.pow(xyz.x, 3) > 0.008856) ? Math.pow(xyz.x, 3) : (xyz.x - 16 / 116) / 7.787;
					xyz.y = (Math.pow(xyz.y, 3) > 0.008856) ? Math.pow(xyz.y, 3) : (xyz.y - 16 / 116) / 7.787;
					xyz.z = (Math.pow(xyz.z, 3) > 0.008856) ? Math.pow(xyz.z, 3) : (xyz.z - 16 / 116) / 7.787;

					xyz.x *= 0.95047;
					xyz.y *= 1;
					xyz.z *= 1.08883;

					return xyz;
				},
				_rgb_to_cmy = function(rgb) {
					return {
						c: 1 - (rgb.r),
						m: 1 - (rgb.g),
						y: 1 - (rgb.b)
					};
				},
				_cmy_to_rgb = function(cmy) {
					return {
						r: 1 - (cmy.c),
						g: 1 - (cmy.m),
						b: 1 - (cmy.y)
					};
				},
				_cmy_to_cmyk = function(cmy) {
					var K = 1;

					if (cmy.c < K) {
						K = cmy.c;
					}
					if (cmy.m < K) {
						K = cmy.m;
					}
					if (cmy.y < K) {
						K = cmy.y;
					}

					if (K == 1) {
						return {
							c: 0,
							m: 0,
							y: 0,
							k: 1
						};
					}

					return {
						c: (cmy.c - K) / (1 - K),
						m: (cmy.m - K) / (1 - K),
						y: (cmy.y - K) / (1 - K),
						k: K
					};
				},
				_cmyk_to_cmy = function(cmyk) {
					return {
						c: cmyk.c * (1 - cmyk.k) + cmyk.k,
						m: cmyk.m * (1 - cmyk.k) + cmyk.k,
						y: cmyk.y * (1 - cmyk.k) + cmyk.k
					};
				};

			this.set = true;

			this.setAlpha = function(_a) {
				if (_a !== null) {
					a = _clip(_a);
				}

				return this;
			};

			this.getAlpha = function() {
				return a;
			};

			this.setRGB = function(r, g, b) {
				spaces = {rgb: this.getRGB()};
				if (r !== null) {
					spaces.rgb.r = _clip(r);
				}
				if (g !== null) {
					spaces.rgb.g = _clip(g);
				}
				if (b !== null) {
					spaces.rgb.b = _clip(b);
				}

				return this;
			};

			this.setHSV = function(h, s, v) {
				spaces = {hsv: this.getHSV()};
				if (h !== null) {
					spaces.hsv.h = _clip(h);
				}
				if (s !== null)	{
					spaces.hsv.s = _clip(s);
				}
				if (v !== null)	{
					spaces.hsv.v = _clip(v);
				}

				return this;
			};

			this.setHSL = function(h, s, l) {
				spaces = {hsl: this.getHSL()};
				if (h !== null)	{
					spaces.hsl.h = _clip(h);
				}
				if (s !== null) {
					spaces.hsl.s = _clip(s);
				}
				if (l !== null) {
					spaces.hsl.l = _clip(l);
				}

				return this;
			};

			this.setLAB = function(l, a, b) {
				spaces = {lab: this.getLAB()};
				if (l !== null) {
					spaces.lab.l = _clip(l);
				}
				if (a !== null) {
					spaces.lab.a = _clip(a);
				}
				if (b !== null) {
					spaces.lab.b = _clip(b);
				}

				return this;
			};

			this.setCMYK = function(c, m, y, k) {
				spaces = {cmyk: this.getCMYK()};
				if (c !== null) {
					spaces.cmyk.c = _clip(c);
				}
				if (m !== null) {
					spaces.cmyk.m = _clip(m);
				}
				if (y !== null) {
					spaces.cmyk.y = _clip(y);
				}
				if (k !== null) {
					spaces.cmyk.k = _clip(k);
				}

				return this;
			};

			this.getRGB = function() {
				if (!spaces.rgb) {
					spaces.rgb	= spaces.lab ?	_xyz_to_rgb(_lab_to_xyz(spaces.lab))
								: spaces.hsv ?	_hsv_to_rgb(spaces.hsv)
								: spaces.hsl ?	_hsl_to_rgb(spaces.hsl)
								: spaces.cmyk ?	_cmy_to_rgb(_cmyk_to_cmy(spaces.cmyk))
								: {r: 0, g: 0, b: 0};
					spaces.rgb.r = _clip(spaces.rgb.r);
					spaces.rgb.g = _clip(spaces.rgb.g);
					spaces.rgb.b = _clip(spaces.rgb.b);
				}
				return $.extend({}, spaces.rgb);
			};

			this.getHSV = function() {
				if (!spaces.hsv) {
					spaces.hsv	= spaces.lab ? _rgb_to_hsv(this.getRGB())
								: spaces.rgb ?	_rgb_to_hsv(spaces.rgb)
								: spaces.hsl ?	_rgb_to_hsv(this.getRGB())
								: spaces.cmyk ?	_rgb_to_hsv(this.getRGB())
								: {h: 0, s: 0, v: 0};
					spaces.hsv.h = _clip(spaces.hsv.h);
					spaces.hsv.s = _clip(spaces.hsv.s);
					spaces.hsv.v = _clip(spaces.hsv.v);
				}
				return $.extend({}, spaces.hsv);
			};

			this.getHSL = function() {
				if (!spaces.hsl) {
					spaces.hsl	= spaces.rgb ?	_rgb_to_hsl(spaces.rgb)
								: spaces.hsv ?	_rgb_to_hsl(this.getRGB())
								: spaces.cmyk ?	_rgb_to_hsl(this.getRGB())
								: spaces.hsv ?	_rgb_to_hsl(this.getRGB())
								: {h: 0, s: 0, l: 0};
					spaces.hsl.h = _clip(spaces.hsl.h);
					spaces.hsl.s = _clip(spaces.hsl.s);
					spaces.hsl.l = _clip(spaces.hsl.l);
				}
				return $.extend({}, spaces.hsl);
			};

			this.getCMYK = function() {
				if (!spaces.cmyk) {
					spaces.cmyk	= spaces.rgb ?	_cmy_to_cmyk(_rgb_to_cmy(spaces.rgb))
								: spaces.hsv ?	_cmy_to_cmyk(_rgb_to_cmy(this.getRGB()))
								: spaces.hsl ?	_cmy_to_cmyk(_rgb_to_cmy(this.getRGB()))
								: spaces.lab ?	_cmy_to_cmyk(_rgb_to_cmy(this.getRGB()))
								: {c: 0, m: 0, y: 0, k: 1};
					spaces.cmyk.c = _clip(spaces.cmyk.c);
					spaces.cmyk.m = _clip(spaces.cmyk.m);
					spaces.cmyk.y = _clip(spaces.cmyk.y);
					spaces.cmyk.k = _clip(spaces.cmyk.k);
				}
				return $.extend({}, spaces.cmyk);
			};

			this.getLAB = function() {
				if (!spaces.lab) {
					spaces.lab	= spaces.rgb ?	_xyz_to_lab(_rgb_to_xyz(spaces.rgb))
								: spaces.hsv ?	_xyz_to_lab(_rgb_to_xyz(this.getRGB()))
								: spaces.hsl ?	_xyz_to_lab(_rgb_to_xyz(this.getRGB()))
								: spaces.cmyk ?	_xyz_to_lab(_rgb_to_xyz(this.getRGB()))
								: {l: 0, a: 0, b: 0};
					spaces.lab.l = _clip(spaces.lab.l);
					spaces.lab.a = _clip(spaces.lab.a);
					spaces.lab.b = _clip(spaces.lab.b);
				}
				return $.extend({}, spaces.lab);
			};

			this.getChannels = function() {
				return {
					r:	this.getRGB().r,
					g:	this.getRGB().g,
					b:	this.getRGB().b,
					a:	this.getAlpha(),
					h:	this.getHSV().h,
					s:	this.getHSV().s,
					v:	this.getHSV().v,
					c:	this.getCMYK().c,
					m:	this.getCMYK().m,
					y:	this.getCMYK().y,
					k:	this.getCMYK().k,
					L:	this.getLAB().l,
					A:	this.getLAB().a,
					B:	this.getLAB().b
				};
			};
			
			this.getSpaces = function() {
				return $.extend(true, {}, spaces);
			};
			
			this.setSpaces = function(new_spaces) {
				spaces = new_spaces;
				return this;
			};
			
			this.distance = function(color) {
				var space	= 'lab',
					getter	= 'get'+space.toUpperCase(),
					a = this[getter](),
					b = color[getter](),
					distance = 0,
					channel;

				for (channel in a) {
					distance += Math.pow(a[channel] - b[channel], 2);
				}

				return distance;
			};

			this.equals = function(color) {
				var a = this.getRGB(),
					b = color.getRGB();

				return this.getAlpha() == color.getAlpha()
					&& a.r == b.r
					&& a.g == b.g
					&& a.b == b.b;
			};

			this.limit = function(steps) {
				steps -= 1;
				var rgb = this.getRGB();
				this.setRGB(
					Math.round(rgb.r * steps) / steps,
					Math.round(rgb.g * steps) / steps,
					Math.round(rgb.b * steps) / steps
				);
			};

			this.toHex = function() {
				var rgb = this.getRGB();
				return _hexify(rgb.r * 255) + _hexify(rgb.g * 255) + _hexify(rgb.b * 255);
			};

			this.toCSS = function() {
				return '#' + this.toHex();
			};

			this.normalize = function() {
				this.setHSV(null, 1, 1);
				return this;
			};

			this.copy = function() {
				var spaces = this.getSpaces(),
					a = this.getAlpha();
				return new Color(spaces, a);
			};

			// Construct
			if (args.length == 2) {
				this.setSpaces(args[0]);
				this.setAlpha(args[1] === 0 ? 0 : args[1] || 1);
			}
			if (args.length > 2) {
				this.setRGB(args[0], args[1], args[2]);
				this.setAlpha(args[3] === 0 ? 0 : args[3] || 1);
			}
		};

	$.widget("vanderlee.colorpicker", {
		options: {
			alpha:				false,		// Show alpha controls and mode
			altAlpha:			true,		// change opacity of altField as well?
			altField:			'',			// selector for DOM elements which change background color on change.
			altOnChange:		true,		// true to update on each change, false to update only on close.
			altProperties:		'background-color',	// comma separated list of any of 'background-color', 'color', 'border-color', 'outline-color'
			autoOpen:			false,		// Open dialog automatically upon creation
			buttonColorize:		false,
			buttonImage:		'images/ui-colorpicker.png',
			buttonImageOnly:	false,
			buttonText:			null,		// Text on the button and/or title of button image.
			closeOnEscape:		true,		// Close the dialog when the escape key is pressed.
			closeOnOutside:		true,		// Close the dialog when clicking outside the dialog (not for inline)
			color:				'#00FF00',	// Initial color (for inline only)
			colorFormat:		'HEX',		// Format string for output color format
			draggable:			true,		// Make popup dialog draggable if header is visible.
			duration:			'fast',
			hsv:				true,		// Show HSV controls and modes
			inline:				true,		// Show any divs as inline by default
			layout: {
				map:		[0, 0, 1, 5],	// Left, Top, Width, Height (in table cells).
				bar:		[1, 0, 1, 5],
				preview:	[2, 0, 1, 1],
				hsv:		[2, 1, 1, 1],
				rgb:		[2, 2, 1, 1],
				alpha:		[2, 3, 1, 1],
				hex:		[2, 4, 1, 1],
				lab:		[3, 1, 1, 1],
				cmyk:		[3, 2, 1, 2],
				swatches:	[4, 0, 1, 5]
			},
			limit:				'',			// Limit color "resolution": '', 'websafe', 'nibble', 'binary', 'name'
			modal:				false,		// Modal dialog?
			mode:				'h',		// Initial editing mode, h, s, v, r, g, b or a
			parts:				'',			// leave empty for automatic selection
			regional:			'',
			rgb:				true,		// Show RGB controls and modes
			showAnim:			'fadeIn',
			showCancelButton:	true,
			showNoneButton:		false,
			showCloseButton:	true,
			showOn:				'focus',	// 'focus', 'button', 'both'
			showOptions:		{},
			swatches:			null,		// null for default or kv-object or names swatches set
			swatchesWidth:		84,			// width (in number of pixels) of swatches box.
			title:				null,

			close:              null,
			init:				null,
			select:             null,
			open:               null
		},

		_create: function () {
			var that = this,
				text;

			++_colorpicker_index;

			that.widgetEventPrefix = 'color';

			that.opened		= false;
			that.generated	= false;
			that.inline		= false;
			that.changed	= false;

			that.dialog		= null;
			that.button		= null;
			that.image		= null;
			that.overlay	= null;

			that.mode		= that.options.mode;

			if (this.element[0].nodeName.toLowerCase() === 'input' || !that.options.inline) {
				that._setColor(that.element.val());

				this._callback('init');

				$('body').append(_container_popup);
				that.dialog = $('.ui-colorpicker:last');

				// Click outside/inside
				$(document).mousedown(function (event) {
					if (!that.opened || event.target === that.element[0] || that.overlay) {
						return;
					}

					// Check if clicked on any part of dialog
					if (that.dialog.is(event.target) || that.dialog.has(event.target).length > 0) {
						that.element.blur();	// inside window!
						return;
					}

					// Check if clicked on button
					var p,
						parents = $(event.target).parents();
					for (p = 0; p <= parents.length; ++p) {
						if (that.button !== null && parents[p] === that.button[0]) {
							return;
						}
					}

					// no closeOnOutside
					if (!that.options.closeOnOutside) {
						return;
					}

					that.close();
				});

				$(document).keydown(function (event) {
					if (event.keyCode == 27 && that.opened && that.options.closeOnEscape) {
						that.close();
					}
				});

				if (that.options.showOn === 'focus' || that.options.showOn === 'both') {
					that.element.on('focus click', function () {
						that.open();
					});
				}
				if (that.options.showOn === 'button' || that.options.showOn === 'both') {
					if (that.options.buttonImage !== '') {
						text = that.options.buttonText || that._getRegional('button');

						that.image = $('<img/>').attr({
							'src':		that.options.buttonImage,
							'alt':		text,
							'title':	text
						});

						that._setImageBackground();
					}

					if (that.options.buttonImageOnly && that.image) {
						that.button = that.image;
					} else {
						that.button = $('<button type="button"></button>').html(that.image || that.options.buttonText).button();
						that.image = that.image ? $('img', that.button).first() : null;
					}
					that.button.insertAfter(that.element).click(function () {
						that[that.opened ? 'close' : 'open']();
					});
				}

				if (that.options.autoOpen) {
					that.open();
				}

				that.element.keydown(function (event) {
					if (event.keyCode === 9) {
						that.close();
					}
				}).keyup(function (event) {
					var color = that._parseColor(that.element.val());
					if (!that.color.equals(color)) {
						that.color = color;
						that._change();
					}
				});
			} else {
				that.inline = true;

				$(this.element).html(_container_inline);
				that.dialog = $('.ui-colorpicker', this.element);

				that._generate();

				that.opened = true;
			}

			return this;
		},

		_setOption: function(key, value){
			var that = this;

			switch (key) {
			case "disabled":
				if (value) {
					that.dialog.addClass('ui-colorpicker-disabled');
				} else {
					that.dialog.removeClass('ui-colorpicker-disabled');
				}
				break;
			}

			$.Widget.prototype._setOption.apply(that, arguments);
		},

		/* setBackground */
		_setImageBackground: function() {
			if (this.image && this.options.buttonColorize) {
				this.image.css('background-color', this.color.set? this._formatColor('RGBA', this.color) : '');
			}
		},

		/**
		 * If an alternate field is specified, set it according to the current color.
		 */
		_setAltField: function () {
			if (this.options.altOnChange && this.options.altField && this.options.altProperties) {
				var index,
					property,
					properties = this.options.altProperties.split(',');

				for (index = 0; index <= properties.length; ++index) {
					property = $.trim(properties[index]);
					switch (property) {
						case 'color':
						case 'background-color':
						case 'outline-color':
						case 'border-color':
							$(this.options.altField).css(property, this.color.set? this.color.toCSS() : '');
							break;
					}
				}

				if (this.options.altAlpha) {
					$(this.options.altField).css('opacity', this.color.set? this.color.getAlpha() : '');
				}
			}
		},

		_setColor: function(text) {
			this.color			= this._parseColor(text);
			this.currentColor	= this.color.copy();

			this._setImageBackground();
			this._setAltField();
		},

		setColor: function(text) {
			this._setColor(text);
			this._change(this.color.set);
		},

		_generate: function () {
			var that = this,
				index,
				part,
				parts_list,
				layout_parts;

			// Set color based on element?
			that._setColor(that.inline? that.options.color : that.element.val());

			// Determine the parts to include in this colorpicker
			if (typeof that.options.parts === 'string') {
				if (_parts_lists[that.options.parts]) {
					parts_list = _parts_lists[that.options.parts];
				} else {
					// automatic
					parts_list = _parts_lists[that.inline ? 'inline' : 'popup'];
				}
			} else {
				parts_list = that.options.parts;
			}

			// Add any parts to the internal parts list
			that.parts = {};
			$.each(parts_list, function(index, part) {
				if (_parts[part]) {
					that.parts[part] = new _parts[part](that);
				}
			});

			if (!that.generated) {
				layout_parts = [];

				$.each(that.options.layout, function(part, pos) {
					if (that.parts[part]) {
						layout_parts.push({
							'part': part,
							'pos':  pos
						});
					}
				});

				$(_layoutTable(layout_parts, function(cell, x, y) {
					var classes = ['ui-colorpicker-' + cell.part + '-container'];

					if (x > 0) {
						classes.push('ui-colorpicker-padding-left');
					}

					if (y > 0) {
						classes.push('ui-colorpicker-padding-top');
					}

					return '<td  class="' + classes.join(' ') + '"'
						+ (cell.pos[2] > 1 ? ' colspan="' + cell.pos[2] + '"' : '')
						+ (cell.pos[3] > 1 ? ' rowspan="' + cell.pos[3] + '"' : '')
						+ ' valign="top"></td>';
				})).appendTo(that.dialog).addClass('ui-dialog-content ui-widget-content');

				that._initAllParts();
				that._updateAllParts();
				that.generated = true;
			}
		},

		_effectGeneric: function (element, show, slide, fade, callback) {
			var that = this;

			if ($.effects && $.effects[that.options.showAnim]) {
				element[show](that.options.showAnim, that.options.showOptions, that.options.duration, callback);
			} else {
				element[(that.options.showAnim === 'slideDown' ?
								slide
							:	(that.options.showAnim === 'fadeIn' ?
									fade
								:	show))]((that.options.showAnim ? that.options.duration : null), callback);
				if (!that.options.showAnim || !that.options.duration) {
					callback();
				}
			}
		},

		_effectShow: function(element, callback) {
			this._effectGeneric(element, 'show', 'slideDown', 'fadeIn', callback);
		},

		_effectHide: function(element, callback) {
			this._effectGeneric(element, 'hide', 'slideUp', 'fadeOut', callback);
		},

		open: function() {
		   
			var that = this,
				offset,
				bottom,
				right,
				height,
				width,
				x,
				y,
				zIndex;

			if (!that.opened) {
				that._generate();

				offset	= that.element.offset();
				bottom	= $(window).height() + $(window).scrollTop();
				right	= $(window).width() + $(window).scrollLeft();
				height	= that.dialog.outerHeight();
				width	= that.dialog.outerWidth();
				x		= offset.left;
				y		= offset.top + that.element.outerHeight();

				if (x + width > right) {
					x = Math.max(0, right - width);
				}

				if (y + height > bottom) {
					if (offset.top - height >= $(window).scrollTop()) {
						y = offset.top - height;
					} else {
						y = Math.max(0, bottom - height);
					}
				}

				that.dialog.css({'left': x, 'top': y});

				// Automatically find highest z-index.
				zIndex = 0;
				$(that.element[0]).parents().each(function() {
					var z = $(this).css('z-index');
					if ((typeof(z) === 'number' || typeof(z) === 'string') && z !== '' && !isNaN(z)) {
						zIndex = z;
						return false;
					}
				});

				//@todo zIndexOffset option, to raise above other elements?
				that.dialog.css('z-index', zIndex += 2);

				that.overlay = that.options.modal ? new $.ui.dialog.overlay(that) : null;

				that._effectShow(this.dialog);
				that.opened = true;
				that._callback('open', true);

				// Without waiting for domready the width of the map is 0 and we
				// wind up with the cursor stuck in the upper left corner
				$(function() {
					that._repaintAllParts();
				});
			}
		},

		close: function () {
			var that = this;

			that.currentColor	= that.color.copy();
			that.changed		= false;

			// tear down the interface
			that._effectHide(that.dialog, function () {
				that.dialog.empty();
				that.generated	= false;

				that.opened		= false;
				that._callback('close', true);
			});

			if (that.overlay) {
				that.overlay.destroy();
			}
		},

		destroy: function() {
			this.element.unbind();

			if (this.image !== null) {
				this.image.remove();
			}

			if (this.button !== null) {
				this.button.remove();
			}

			if (this.dialog !== null) {
				this.dialog.remove();
			}

			if (this.overlay) {
				this.overlay.destroy();
			}
		},

		_callback: function (callback, spaces) {
			var that = this,
				data,
				lab;

			if (that.color.set) {
				data = {
					formatted: that._formatColor(that.options.colorFormat, that.color)
				};

				lab = that.color.getLAB();
				lab.a = (lab.a * 2) - 1;
				lab.b = (lab.b * 2) - 1;

				if (spaces === true) {
					data.a		= that.color.getAlpha();
					data.rgb	= that.color.getRGB();
					data.hsv	= that.color.getHSV();
					data.cmyk	= that.color.getCMYK();
					data.hsl	= that.color.getHSL();
					data.lab	= lab;
				}

				return that._trigger(callback, null, data);
			} else {
				return that._trigger(callback, null, {
					formatted: ''
				});
			}
		},

		_initAllParts: function () {
			$.each(this.parts, function (index, part) {
				if (part.init) {
					part.init();
				}
			});
		},

		_updateAllParts: function () {
			$.each(this.parts, function (index, part) {
				if (part.update) {
					part.update();
				}
			});
		},

		_repaintAllParts: function () {
			$.each(this.parts, function (index, part) {
				if (part.repaint) {
					part.repaint();
				}
			});
		},

		_change: function (set /* = true */) {
			this.color.set = (set !== false);

			this.changed = true;

			// Limit color palette
			switch (this.options.limit) {
				case 'websafe':
					this.color.limit(6);
					break;

				case 'nibble':
					this.color.limit(16);
					break;

				case 'binary':
					this.color.limit(2);
					break;

				case 'name':
					var swatch = this._getSwatch(this._closestName(this.color));
					this.color.setRGB(swatch.r, swatch.g, swatch.b);
					break;
			}

			// update input element content
			if (!this.inline) {
				if (!this.color.set) {
					this.element.val('');
				} else if (!this.color.equals(this._parseColor(this.element.val()))) {
					this.element.val(this._formatColor(this.options.colorFormat, this.color));
				}

				this._setImageBackground();
				this._setAltField();
			}

			if (this.opened) {
				this._repaintAllParts();
			}

			// callback
			this._callback('select');
		},

		// This will be deprecated by jQueryUI 1.9 widget
		_hoverable: function (e) {
			e.hover(function () {
				e.addClass("ui-state-hover");
			}, function () {
				e.removeClass("ui-state-hover");
			});
		},

		// This will be deprecated by jQueryUI 1.9 widget
		_focusable: function (e) {
			e.focus(function () {
				e.addClass("ui-state-focus");
			}).blur(function () {
				e.removeClass("ui-state-focus");
			});
		},

		_getRegional: function(name) {
			return $.colorpicker.regional[this.options.regional][name] !== undefined ?
				$.colorpicker.regional[this.options.regional][name] : $.colorpicker.regional[''][name];
        },

		_getSwatches: function() {
			if (typeof(this.options.swatches) === 'string') {
				return $.colorpicker.swatches[this.options.swatches];
			}

			if ($.isPlainObject(this.options.swatches)) {
				return $.colorpicker.swatches;
			}

			return $.colorpicker.swatches.html;
		},

		_getSwatch: function(name) {
			var swatches = this._getSwatches(),
				swatch = false;

			if (swatches[name] !== undefined) {
				return swatches[name];
			}
			
			$.each(swatches, function(swatchName, current) {
				if (swatchName.toLowerCase() == name.toLowerCase()) {
					swatch = current;
					return false;
				}
				return true;
			});
			
			return swatch;
        },

        _parseColor: function(color) {
            var c,
				m;

			// no color
            if (color == '') {
                return new Color();
            }

			// named swatch
			c = this._getSwatch($.trim(color));
            if (c) {
                return new Color(c.r, c.g, c.b);
            }

            // rgba(r,g,b,a)
            m = /^rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)$/.exec(color);
            if (m) {
                return new Color(
                    m[1] / 255,
                    m[2] / 255,
                    m[3] / 255,
                    parseFloat(m[4])
                );
            }

            // hsla(r,g,b,a)
            m = /^hsla?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)$/.exec(color);
            if (m) {
				return (new Color()).setHSL(
					m[1] / 255,
					m[2] / 255,
					m[3] / 255).setAlpha(parseFloat(m[4]));
            }

            // rgba(r%,g%,b%,a%)
            m = /^rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)$/.exec(color);
            if (m) {
                return new Color(
                    m[1] / 100,
                    m[2] / 100,
                    m[3] / 100,
                    m[4] / 100
                );
            }

            // hsla(r%,g%,b%,a%)
            m = /^hsla?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)$/.exec(color);
            if (m) {
				return (new Color()).setHSL(
					m[1] / 100,
					m[2] / 100,
					m[3] / 100).setAlpha(m[4] / 100);
            }

            // #rrggbb
            m = /^#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})$/.exec(color);
            if (m) {
                return new Color(
                    parseInt(m[1], 16) / 255,
                    parseInt(m[2], 16) / 255,
                    parseInt(m[3], 16) / 255
                );
            }

            // #rgb
            m = /^#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])$/.exec(color);
            if (m) {
                return new Color(
                   parseInt(m[1] + m[1], 16) / 255,
                   parseInt(m[2] + m[2], 16) / 255,
                   parseInt(m[3] + m[3], 16) / 255
                );
            }
			
			return _parseHex(color);
        },

		_exactName: function(color) {
			var name	= false;

			$.each(this._getSwatches(), function(n, swatch) {
				if (color.equals(new Color(swatch.r, swatch.g, swatch.b))) {
					name = n;
					return false;
				}
				return true;
			});

			return name;
		},

		_closestName: function(color) {
			var rgb			= color.getRGB(),
				distance	= null,
				name		= false,
				d;

			$.each(this._getSwatches(), function(n, swatch) {
				d = color.distance(new Color(swatch.r, swatch.g, swatch.b));
				if (d < distance || distance === null) {
					name = n;
					if (d == 0) {
						return false;	// can't get much closer than 0
					}
					distance = d;
				}
				return true;
			});

			return name;
		},

		_formatColor: function (formats, color) {
			var that		= this,
				text		= null,
				types		= {	'x':	function(v) {return _intToHex(v * 255);}
							,	'd':	function(v) {return Math.round(v * 255);}
							,	'f':	function(v) {return v;}
							,	'p':	function(v) {return v * 100;}
							},
				channels	= color.getChannels();

			if (!$.isArray(formats)) {
				formats = [formats];
			}

			$.each(formats, function(index, format) {
				if (that._formats[format]) {
					text = that._formats[format](color, that);
					return (text === false);
				} else {
					text = format.replace(/\\?[argbhsvcmykLAB][xdfp]/g, function(m) {
						if (m.match(/^\\/)) {
							return m.slice(1);
						}
						return types[m.charAt(1)](channels[m.charAt(0)]);
					});
					return false;
				}
			});

			return text;
		},

		_formats: {
			'#HEX':		function(color, that) {
							return that._formatColor('#rxgxbx', color);
						}
		,	'#HEX3':	function(color, that) {
							var hex3 = that._formats.HEX3(color);
							return hex3 === false? false : '#'+hex3;
						}
		,	'HEX':		function(color, that) {
							return that._formatColor('rxgxbx', color);
						}
		,	'HEX3':		function(color, that) {
							var rgb = color.getRGB(),
								r = Math.round(rgb.r * 255),
								g = Math.round(rgb.g * 255),
								b = Math.round(rgb.b * 255);

							if (((r >>> 4) == (r &= 0xf))
							 && ((g >>> 4) == (g &= 0xf))
							 && ((b >>> 4) == (b &= 0xf))) {
								return r.toString(16)+g.toString(16)+b.toString(16);
							}
							return false;
						}
		,	'RGB':		function(color, that) {
							return color.getAlpha() >= 1
									? that._formatColor('rgb(rd,gd,bd)', color)
									: false;
						}
		,	'RGBA':		function(color, that) {
							return that._formatColor('rgba(rd,gd,bd,af)', color);
						}
		,	'RGB%':		function(color, that) {
							return color.getAlpha() >= 1
									? that._formatColor('rgb(rp%,gp%,bp%)', color)
									: false;
						}
		,	'RGBA%':	function(color, that) {
							return that._formatColor('rgba(rp%,gp%,bp%,af)', color);
						}
		,	'HSL':		function(color, that) {
							return color.getAlpha() >= 1
									? that._formatColor('hsl(hd,sd,vd)', color)
									: false;
						}
		,	'HSLA':		function(color, that) {
							return that._formatColor('hsla(hd,sd,vd,af)', color);
						}
		,	'HSL%':		function(color, that) {
							return color.getAlpha() >= 1
									? that._formatColor('hsl(hp%,sp%,vp%)', color)
									: false;
						}
		,	'HSLA%':	function(color, that) {
							return that._formatColor('hsla(hp%,sp%,vp%,af)', color);
						}
		,	'NAME':		function(color, that) {
							return that._closestName(color);
						}
		,	'EXACT':	function(color, that) {		//@todo experimental. Implement a good fallback list
							return that._exactName(color);
						}
		}
	});
}(jQuery));










jQuery(function($) {
	$.colorpicker.swatches['pantone'] = {
		'100': {r: 0.956862745098039, g: 0.929411764705882, b: 0.486274509803922},
		'101': {r: 0.956862745098039, g: 0.929411764705882, b: 0.27843137254902},
		'102': {r: 0.976470588235294, g: 0.909803921568627, b: 0.0784313725490196},
		'103': {r: 0.776470588235294, g: 0.67843137254902, b: 0.0588235294117647},
		'104': {r: 0.67843137254902, g: 0.607843137254902, b: 0.0470588235294118},
		'105': {r: 0.509803921568627, g: 0.458823529411765, b: 0.0588235294117647},
		'106': {r: 0.968627450980392, g: 0.909803921568627, b: 0.349019607843137},
		'107': {r: 0.976470588235294, g: 0.898039215686275, b: 0.149019607843137},
		'108': {r: 0.976470588235294, g: 0.866666666666667, b: 0.0862745098039216},
		'109': {r: 0.976470588235294, g: 0.83921568627451, b: 0.0862745098039216},
		'110': {r: 0.847058823529412, g: 0.709803921568627, b: 0.0666666666666667},
		'111': {r: 0.666666666666667, g: 0.576470588235294, b: 0.0392156862745098},
		'112': {r: 0.6, g: 0.517647058823529, b: 0.0392156862745098},
		'113': {r: 0.976470588235294, g: 0.898039215686275, b: 0.356862745098039},
		'114': {r: 0.976470588235294, g: 0.886274509803922, b: 0.298039215686275},
		'115': {r: 0.976470588235294, g: 0.87843137254902, b: 0.298039215686275},
		'116': {r: 0.988235294117647, g: 0.819607843137255, b: 0.0862745098039216},
		'116 2X': {r: 0.968627450980392, g: 0.709803921568627, b: 0.0470588235294118},
		'117': {r: 0.776470588235294, g: 0.627450980392157, b: 0.0470588235294118},
		'118': {r: 0.666666666666667, g: 0.556862745098039, b: 0.0392156862745098},
		'119': {r: 0.537254901960784, g: 0.466666666666667, b: 0.0980392156862745},
		'120': {r: 0.976470588235294, g: 0.886274509803922, b: 0.498039215686275},
		'1205': {r: 0.968627450980392, g: 0.909803921568627, b: 0.666666666666667},
		'121': {r: 0.976470588235294, g: 0.87843137254902, b: 0.43921568627451},
		'1215': {r: 0.976470588235294, g: 0.87843137254902, b: 0.549019607843137},
		'122': {r: 0.988235294117647, g: 0.847058823529412, b: 0.337254901960784},
		'1225': {r: 1, g: 0.8, b: 0.286274509803922},
		'123': {r: 1, g: 0.776470588235294, b: 0.117647058823529},
		'1235': {r: 0.988235294117647, g: 0.709803921568627, b: 0.0784313725490196},
		'124': {r: 0.87843137254902, g: 0.666666666666667, b: 0.0588235294117647},
		'1245': {r: 0.749019607843137, g: 0.568627450980392, b: 0.0470588235294118},
		'125': {r: 0.709803921568627, g: 0.549019607843137, b: 0.0392156862745098},
		'1255': {r: 0.63921568627451, g: 0.498039215686275, b: 0.0784313725490196},
		'126': {r: 0.63921568627451, g: 0.509803921568627, b: 0.0096078431372549},
		'1265': {r: 0.486274509803922, g: 0.388235294117647, b: 0.0862745098039216},
		'127': {r: 0.956862745098039, g: 0.886274509803922, b: 0.529411764705882},
		'128': {r: 0.956862745098039, g: 0.858823529411765, b: 0.376470588235294},
		'129': {r: 0.949019607843137, g: 0.819607843137255, b: 0.23921568627451},
		'130': {r: 0.917647058823529, g: 0.686274509803922, b: 0.0588235294117647},
		'130 2X': {r: 0.886274509803922, g: 0.568627450980392, b: 0},
		'131': {r: 0.776470588235294, g: 0.576470588235294, b: 0.0392156862745098},
		'132': {r: 0.619607843137255, g: 0.486274509803922, b: 0.0392156862745098},
		'133': {r: 0.43921568627451, g: 0.356862745098039, b: 0.0392156862745098},
		'134': {r: 1, g: 0.847058823529412, b: 0.498039215686275},
		'1345': {r: 1, g: 0.83921568627451, b: 0.568627450980392},
		'135': {r: 0.988235294117647, g: 0.788235294117647, b: 0.388235294117647},
		'1355': {r: 0.988235294117647, g: 0.807843137254902, b: 0.529411764705882},
		'136': {r: 0.988235294117647, g: 0.749019607843137, b: 0.286274509803922},
		'1365': {r: 0.988235294117647, g: 0.729411764705882, b: 0.368627450980392},
		'137': {r: 0.988235294117647, g: 0.63921568627451, b: 0.0666666666666667},
		'1375': {r: 0.976470588235294, g: 0.607843137254902, b: 0.0470588235294118},
		'138': {r: 0.847058823529412, g: 0.549019607843137, b: 0.00784313725490196},
		'1385': {r: 0.8, g: 0.47843137254902, b: 0.00784313725490196},
		'139': {r: 0.686274509803922, g: 0.458823529411765, b: 0.0096078431372549},
		'1395': {r: 0.6, g: 0.376470588235294, b: 0.0274509803921569},
		'140': {r: 0.47843137254902, g: 0.356862745098039, b: 0.0666666666666667},
		'1405': {r: 0.419607843137255, g: 0.27843137254902, b: 0.0784313725490196},
		'141': {r: 0.949019607843137, g: 0.807843137254902, b: 0.407843137254902},
		'142': {r: 0.949019607843137, g: 0.749019607843137, b: 0.286274509803922},
		'143': {r: 0.937254901960784, g: 0.698039215686274, b: 0.176470588235294},
		'144': {r: 0.886274509803922, g: 0.549019607843137, b: 0.0096078431372549},
		'145': {r: 0.776470588235294, g: 0.498039215686275, b: 0.0274509803921569},
		'146': {r: 0.619607843137255, g: 0.419607843137255, b: 0.0096078431372549},
		'147': {r: 0.447058823529412, g: 0.368627450980392, b: 0.149019607843137},
		'148': {r: 1, g: 0.83921568627451, b: 0.607843137254902},
		'1485': {r: 1, g: 0.717647058823529, b: 0.466666666666667},
		'149': {r: 0.988235294117647, g: 0.8, b: 0.576470588235294},
		'1495': {r: 1, g: 0.6, b: 0.247058823529412},
		'150': {r: 0.988235294117647, g: 0.67843137254902, b: 0.337254901960784},
		'1505': {r: 0.956862745098039, g: 0.486274509803922, b: 0},
		'151': {r: 0.968627450980392, g: 0.498039215686275, b: 0},
		'152': {r: 0.866666666666667, g: 0.458823529411765, b: 0},
		'1525': {r: 0.709803921568627, g: 0.329411764705882, b: 0},
		'153': {r: 0.737254901960784, g: 0.427450980392157, b: 0.0392156862745098},
		'1535': {r: 0.549019607843137, g: 0.266666666666667, b: 0},
		'154': {r: 0.6, g: 0.349019607843137, b: 0.0096078431372549},
		'1545': {r: 0.27843137254902, g: 0.133333333333333, b: 0},
		'155': {r: 0.956862745098039, g: 0.858823529411765, b: 0.666666666666667},
		'1555': {r: 0.976470588235294, g: 0.749019607843137, b: 0.619607843137255},
		'156': {r: 0.949019607843137, g: 0.776470588235294, b: 0.549019607843137},
		'1565': {r: 0.988235294117647, g: 0.647058823529412, b: 0.466666666666667},
		'157': {r: 0.929411764705882, g: 0.627450980392157, b: 0.309803921568627},
		'1575': {r: 0.988235294117647, g: 0.529411764705882, b: 0.266666666666667},
		'158': {r: 0.909803921568627, g: 0.458823529411765, b: 0.0666666666666667},
		'1585': {r: 0.976470588235294, g: 0.419607843137255, b: 0.0274509803921569},
		'159': {r: 0.776470588235294, g: 0.376470588235294, b: 0.0096078431372549},
		'1595': {r: 0.819607843137255, g: 0.356862745098039, b: 0.0096078431372549},
		'160': {r: 0.619607843137255, g: 0.329411764705882, b: 0.0392156862745098},
		'1605': {r: 0.627450980392157, g: 0.309803921568627, b: 0.0666666666666667},
		'161': {r: 0.388235294117647, g: 0.227450980392157, b: 0.0666666666666667},
		'1615': {r: 0.517647058823529, g: 0.247058823529412, b: 0.0588235294117647},
		'162': {r: 0.976470588235294, g: 0.776470588235294, b: 0.666666666666667},
		'1625': {r: 0.976470588235294, g: 0.647058823529412, b: 0.549019607843137},
		'163': {r: 0.988235294117647, g: 0.619607843137255, b: 0.43921568627451},
		'1635': {r: 0.976470588235294, g: 0.556862745098039, b: 0.427450980392157},
		'164': {r: 0.988235294117647, g: 0.498039215686275, b: 0.247058823529412},
		'1645': {r: 0.976470588235294, g: 0.447058823529412, b: 0.258823529411765},
		'165': {r: 0.976470588235294, g: 0.388235294117647, b: 0.00784313725490196},
		'165 2X': {r: 0.917647058823529, g: 0.309803921568627, b: 0},
		'1655': {r: 0.976470588235294, g: 0.337254901960784, b: 0.00784313725490196},
		'166': {r: 0.866666666666667, g: 0.349019607843137, b: 0},
		'1665': {r: 0.866666666666667, g: 0.309803921568627, b: 0.0096078431372549},
		'167': {r: 0.737254901960784, g: 0.309803921568627, b: 0.0274509803921569},
		'1675': {r: 0.647058823529412, g: 0.247058823529412, b: 0.0588235294117647},
		'168': {r: 0.427450980392157, g: 0.188235294117647, b: 0.0666666666666667},
		'1685': {r: 0.517647058823529, g: 0.207843137254902, b: 0.0666666666666667},
		'169': {r: 0.976470588235294, g: 0.729411764705882, b: 0.666666666666667},
		'170': {r: 0.976470588235294, g: 0.537254901960784, b: 0.447058823529412},
		'171': {r: 0.976470588235294, g: 0.376470588235294, b: 0.227450980392157},
		'172': {r: 0.968627450980392, g: 0.286274509803922, b: 0.00784313725490196},
		'173': {r: 0.819607843137255, g: 0.266666666666667, b: 0.0784313725490196},
		'174': {r: 0.576470588235294, g: 0.2, b: 0.0666666666666667},
		'175': {r: 0.427450980392157, g: 0.2, b: 0.129411764705882},
		'176': {r: 0.976470588235294, g: 0.686274509803922, b: 0.67843137254902},
		'1765': {r: 0.976470588235294, g: 0.619607843137255, b: 0.63921568627451},
		'1767': {r: 0.976470588235294, g: 0.698039215686274, b: 0.717647058823529},
		'177': {r: 0.976470588235294, g: 0.509803921568627, b: 0.498039215686275},
		'1775': {r: 0.976470588235294, g: 0.517647058823529, b: 0.556862745098039},
		'1777': {r: 0.988235294117647, g: 0.4, b: 0.458823529411765},
		'178': {r: 0.976470588235294, g: 0.368627450980392, b: 0.349019607843137},
		'1785': {r: 0.988235294117647, g: 0.309803921568627, b: 0.349019607843137},
		'1787': {r: 0.956862745098039, g: 0.247058823529412, b: 0.309803921568627},
		'1788': {r: 0.937254901960784, g: 0.168627450980392, b: 0.176470588235294},
		'1788 2X': {r: 0.83921568627451, g: 0.129411764705882, b: 0},
		'179': {r: 0.886274509803922, g: 0.23921568627451, b: 0.156862745098039},
		'1795': {r: 0.83921568627451, g: 0.156862745098039, b: 0.156862745098039},
		'1797': {r: 0.8, g: 0.176470588235294, b: 0.188235294117647},
		'180': {r: 0.756862745098039, g: 0.219607843137255, b: 0.156862745098039},
		'1805': {r: 0.686274509803922, g: 0.149019607843137, b: 0.149019607843137},
		'1807': {r: 0.627450980392157, g: 0.188235294117647, b: 0.2},
		'181': {r: 0.486274509803922, g: 0.176470588235294, b: 0.137254901960784},
		'1810': {r: 0.486274509803922, g: 0.129411764705882, b: 0.117647058823529},
		'1817': {r: 0.356862745098039, g: 0.176470588235294, b: 0.156862745098039},
		'182': {r: 0.976470588235294, g: 0.749019607843137, b: 0.756862745098039},
		'183': {r: 0.988235294117647, g: 0.549019607843137, b: 0.6},
		'184': {r: 0.988235294117647, g: 0.368627450980392, b: 0.447058823529412},
		'185': {r: 0.909803921568627, g: 0.0666666666666667, b: 0.176470588235294},
		'185 2X': {r: 0.819607843137255, g: 0.0862745098039216, b: 0},
		'186': {r: 0.807843137254902, g: 0.0666666666666667, b: 0.149019607843137},
		'187': {r: 0.686274509803922, g: 0.117647058823529, b: 0.176470588235294},
		'188': {r: 0.486274509803922, g: 0.129411764705882, b: 0.156862745098039},
		'189': {r: 1, g: 0.63921568627451, b: 0.698039215686274},
		'1895': {r: 0.988235294117647, g: 0.749019607843137, b: 0.788235294117647},
		'190': {r: 0.988235294117647, g: 0.458823529411765, b: 0.556862745098039},
		'1905': {r: 0.988235294117647, g: 0.607843137254902, b: 0.698039215686274},
		'191': {r: 0.956862745098039, g: 0.27843137254902, b: 0.419607843137255},
		'1915': {r: 0.956862745098039, g: 0.329411764705882, b: 0.486274509803922},
		'192': {r: 0.898039215686275, g: 0.0096078431372549, b: 0.227450980392157},
		'1925': {r: 0.87843137254902, g: 0.0274509803921569, b: 0.27843137254902},
		'193': {r: 0.768627450980392, g: 0, b: 0.262745098039216},
		'1935': {r: 0.756862745098039, g: 0.0096078431372549, b: 0.219607843137255},
		'194': {r: 0.6, g: 0.129411764705882, b: 0.207843137254902},
		'1945': {r: 0.658823529411765, g: 0.0470588235294118, b: 0.207843137254902},
		'1955': {r: 0.576470588235294, g: 0.0862745098039216, b: 0.219607843137255},
		'196': {r: 0.980392156862745, g: 0.835294117647059, b: 0.882352941176471},
		'197': {r: 0.964705882352941, g: 0.647058823529412, b: 0.745098039215686},
		'198': {r: 0.937254901960784, g: 0.356862745098039, b: 0.517647058823529},
		'199': {r: 0.627450980392157, g: 0.152941176470588, b: 0.294117647058824},
		'200': {r: 0.768627450980392, g: 0.117647058823529, b: 0.227450980392157},
		'201': {r: 0.63921568627451, g: 0.149019607843137, b: 0.219607843137255},
		'202': {r: 0.549019607843137, g: 0.149019607843137, b: 0.2},
		'203': {r: 0.949019607843137, g: 0.686274509803922, b: 0.756862745098039},
		'204': {r: 0.929411764705882, g: 0.47843137254902, b: 0.619607843137255},
		'205': {r: 0.898039215686275, g: 0.298039215686275, b: 0.486274509803922},
		'206': {r: 0.827450980392157, g: 0.0096078431372549, b: 0.27843137254902},
		'207': {r: 0.752941176470588, g: 0, b: 0.305882352941176},
		'208': {r: 0.556862745098039, g: 0.137254901960784, b: 0.266666666666667},
		'209': {r: 0.458823529411765, g: 0.149019607843137, b: 0.23921568627451},
		'210': {r: 1, g: 0.627450980392157, b: 0.749019607843137},
		'211': {r: 1, g: 0.466666666666667, b: 0.658823529411765},
		'212': {r: 0.976470588235294, g: 0.309803921568627, b: 0.556862745098039},
		'213': {r: 0.917647058823529, g: 0.0588235294117647, b: 0.419607843137255},
		'214': {r: 0.8, g: 0.00784313725490196, b: 0.337254901960784},
		'215': {r: 0.647058823529412, g: 0.0096078431372549, b: 0.266666666666667},
		'216': {r: 0.486274509803922, g: 0.117647058823529, b: 0.247058823529412},
		'217': {r: 0.956862745098039, g: 0.749019607843137, b: 0.819607843137255},
		'218': {r: 0.929411764705882, g: 0.447058823529412, b: 0.666666666666667},
		'219': {r: 0.886274509803922, g: 0.156862745098039, b: 0.509803921568627},
		'220': {r: 0.666666666666667, g: 0, b: 0.309803921568627},
		'221': {r: 0.576470588235294, g: 0, b: 0.258823529411765},
		'222': {r: 0.43921568627451, g: 0.0980392156862745, b: 0.23921568627451},
		'223': {r: 0.976470588235294, g: 0.576470588235294, b: 0.768627450980392},
		'224': {r: 0.956862745098039, g: 0.419607843137255, b: 0.686274509803922},
		'225': {r: 0.929411764705882, g: 0.156862745098039, b: 0.576470588235294},
		'226': {r: 0.83921568627451, g: 0.00784313725490196, b: 0.43921568627451},
		'227': {r: 0.67843137254902, g: 0, b: 0.356862745098039},
		'228': {r: 0.549019607843137, g: 0, b: 0.298039215686275},
		'229': {r: 0.427450980392157, g: 0.129411764705882, b: 0.247058823529412},
		'230': {r: 1, g: 0.627450980392157, b: 0.8},
		'231': {r: 0.988235294117647, g: 0.43921568627451, b: 0.729411764705882},
		'232': {r: 0.956862745098039, g: 0.247058823529412, b: 0.647058823529412},
		'233': {r: 0.807843137254902, g: 0, b: 0.486274509803922},
		'234': {r: 0.666666666666667, g: 0, b: 0.4},
		'235': {r: 0.556862745098039, g: 0.0096078431372549, b: 0.329411764705882},
		'236': {r: 0.976470588235294, g: 0.686274509803922, b: 0.827450980392157},
		'2365': {r: 0.968627450980392, g: 0.768627450980392, b: 0.847058823529412},
		'237': {r: 0.956862745098039, g: 0.517647058823529, b: 0.768627450980392},
		'2375': {r: 0.917647058823529, g: 0.419607843137255, b: 0.749019607843137},
		'238': {r: 0.929411764705882, g: 0.309803921568627, b: 0.686274509803922},
		'2385': {r: 0.858823529411765, g: 0.156862745098039, b: 0.647058823529412},
		'239': {r: 0.87843137254902, g: 0.129411764705882, b: 0.619607843137255},
		'2395': {r: 0.768627450980392, g: 0, b: 0.549019607843137},
		'240': {r: 0.768627450980392, g: 0.0588235294117647, b: 0.537254901960784},
		'2405': {r: 0.658823529411765, g: 0, b: 0.47843137254902},
		'241': {r: 0.67843137254902, g: 0, b: 0.458823529411765},
		'2415': {r: 0.607843137254902, g: 0, b: 0.43921568627451},
		'242': {r: 0.486274509803922, g: 0.109803921568627, b: 0.317647058823529},
		'2425': {r: 0.529411764705882, g: 0, b: 0.356862745098039},
		'243': {r: 0.949019607843137, g: 0.729411764705882, b: 0.847058823529412},
		'244': {r: 0.929411764705882, g: 0.627450980392157, b: 0.827450980392157},
		'245': {r: 0.909803921568627, g: 0.498039215686275, b: 0.788235294117647},
		'246': {r: 0.8, g: 0, b: 0.627450980392157},
		'247': {r: 0.717647058823529, g: 0, b: 0.556862745098039},
		'248': {r: 0.63921568627451, g: 0.0096078431372549, b: 0.498039215686275},
		'249': {r: 0.498039215686275, g: 0.156862745098039, b: 0.376470588235294},
		'250': {r: 0.929411764705882, g: 0.768627450980392, b: 0.866666666666667},
		'251': {r: 0.886274509803922, g: 0.619607843137255, b: 0.83921568627451},
		'252': {r: 0.827450980392157, g: 0.419607843137255, b: 0.776470588235294},
		'253': {r: 0.686274509803922, g: 0.137254901960784, b: 0.647058823529412},
		'254': {r: 0.627450980392157, g: 0.176470588235294, b: 0.588235294117647},
		'255': {r: 0.466666666666667, g: 0.176470588235294, b: 0.419607843137255},
		'256': {r: 0.898039215686275, g: 0.768627450980392, b: 0.83921568627451},
		'2562': {r: 0.847058823529412, g: 0.658823529411765, b: 0.847058823529412},
		'2563': {r: 0.819607843137255, g: 0.627450980392157, b: 0.8},
		'2567': {r: 0.749019607843137, g: 0.576470588235294, b: 0.8},
		'257': {r: 0.827450980392157, g: 0.647058823529412, b: 0.788235294117647},
		'2572': {r: 0.776470588235294, g: 0.529411764705882, b: 0.819607843137255},
		'2573': {r: 0.729411764705882, g: 0.486274509803922, b: 0.737254901960784},
		'2577': {r: 0.666666666666667, g: 0.447058823529412, b: 0.749019607843137},
		'258': {r: 0.607843137254902, g: 0.309803921568627, b: 0.588235294117647},
		'2582': {r: 0.666666666666667, g: 0.27843137254902, b: 0.729411764705882},
		'2583': {r: 0.619607843137255, g: 0.309803921568627, b: 0.647058823529412},
		'2587': {r: 0.556862745098039, g: 0.27843137254902, b: 0.67843137254902},
		'259': {r: 0.447058823529412, g: 0.0862745098039216, b: 0.419607843137255},
		'2592': {r: 0.576470588235294, g: 0.0588235294117647, b: 0.647058823529412},
		'2593': {r: 0.529411764705882, g: 0.168627450980392, b: 0.576470588235294},
		'2597': {r: 0.4, g: 0, b: 0.549019607843137},
		'260': {r: 0.407843137254902, g: 0.117647058823529, b: 0.356862745098039},
		'2602': {r: 0.509803921568627, g: 0.0470588235294118, b: 0.556862745098039},
		'2603': {r: 0.43921568627451, g: 0.0784313725490196, b: 0.47843137254902},
		'2607': {r: 0.356862745098039, g: 0.00784313725490196, b: 0.47843137254902},
		'261': {r: 0.368627450980392, g: 0.129411764705882, b: 0.329411764705882},
		'2612': {r: 0.43921568627451, g: 0.117647058823529, b: 0.447058823529412},
		'2613': {r: 0.4, g: 0.0666666666666667, b: 0.427450980392157},
		'2617': {r: 0.337254901960784, g: 0.0470588235294118, b: 0.43921568627451},
		'262': {r: 0.329411764705882, g: 0.137254901960784, b: 0.266666666666667},
		'2622': {r: 0.376470588235294, g: 0.176470588235294, b: 0.349019607843137},
		'2623': {r: 0.356862745098039, g: 0.0980392156862745, b: 0.368627450980392},
		'2627': {r: 0.298039215686275, g: 0.0784313725490196, b: 0.368627450980392},
		'263': {r: 0.87843137254902, g: 0.807843137254902, b: 0.87843137254902},
		'2635': {r: 0.788235294117647, g: 0.67843137254902, b: 0.847058823529412},
		'264': {r: 0.776470588235294, g: 0.666666666666667, b: 0.858823529411765},
		'2645': {r: 0.709803921568627, g: 0.568627450980392, b: 0.819607843137255},
		'265': {r: 0.588235294117647, g: 0.388235294117647, b: 0.768627450980392},
		'2655': {r: 0.607843137254902, g: 0.427450980392157, b: 0.776470588235294},
		'266': {r: 0.427450980392157, g: 0.156862745098039, b: 0.666666666666667},
		'2665': {r: 0.537254901960784, g: 0.309803921568627, b: 0.749019607843137},
		'267': {r: 0.349019607843137, g: 0.0666666666666667, b: 0.556862745098039},
		'268': {r: 0.309803921568627, g: 0.129411764705882, b: 0.43921568627451},
		'2685': {r: 0.337254901960784, g: 0, b: 0.549019607843137},
		'269': {r: 0.266666666666667, g: 0.137254901960784, b: 0.349019607843137},
		'2695': {r: 0.266666666666667, g: 0.137254901960784, b: 0.368627450980392},
		'270': {r: 0.729411764705882, g: 0.686274509803922, b: 0.827450980392157},
		'2705': {r: 0.67843137254902, g: 0.619607843137255, b: 0.827450980392157},
		'2706': {r: 0.819607843137255, g: 0.807843137254902, b: 0.866666666666667},
		'2707': {r: 0.749019607843137, g: 0.819607843137255, b: 0.898039215686275},
		'2708': {r: 0.686274509803922, g: 0.737254901960784, b: 0.858823529411765},
		'271': {r: 0.619607843137255, g: 0.568627450980392, b: 0.776470588235294},
		'2715': {r: 0.576470588235294, g: 0.47843137254902, b: 0.8},
		'2716': {r: 0.647058823529412, g: 0.627450980392157, b: 0.83921568627451},
		'2717': {r: 0.647058823529412, g: 0.729411764705882, b: 0.87843137254902},
		'2718': {r: 0.356862745098039, g: 0.466666666666667, b: 0.8},
		'272': {r: 0.537254901960784, g: 0.466666666666667, b: 0.729411764705882},
		'2725': {r: 0.447058823529412, g: 0.317647058823529, b: 0.737254901960784},
		'2726': {r: 0.4, g: 0.337254901960784, b: 0.737254901960784},
		'2727': {r: 0.368627450980392, g: 0.407843137254902, b: 0.768627450980392},
		'2728': {r: 0.188235294117647, g: 0.266666666666667, b: 0.709803921568627},
		'273': {r: 0.219607843137255, g: 0.0980392156862745, b: 0.47843137254902},
		'2735': {r: 0.309803921568627, g: 0, b: 0.576470588235294},
		'2736': {r: 0.286274509803922, g: 0.188235294117647, b: 0.67843137254902},
		'2738': {r: 0.176470588235294, g: 0, b: 0.556862745098039},
		'274': {r: 0.168627450980392, g: 0.0666666666666667, b: 0.4},
		'2745': {r: 0.247058823529412, g: 0, b: 0.466666666666667},
		'2746': {r: 0.247058823529412, g: 0.156862745098039, b: 0.576470588235294},
		'2747': {r: 0.109803921568627, g: 0.0784313725490196, b: 0.419607843137255},
		'2748': {r: 0.117647058823529, g: 0.109803921568627, b: 0.466666666666667},
		'275': {r: 0.149019607843137, g: 0.0588235294117647, b: 0.329411764705882},
		'2755': {r: 0.207843137254902, g: 0, b: 0.427450980392157},
		'2756': {r: 0.2, g: 0.156862745098039, b: 0.458823529411765},
		'2757': {r: 0.0784313725490196, g: 0.0862745098039216, b: 0.329411764705882},
		'2758': {r: 0.0980392156862745, g: 0.129411764705882, b: 0.407843137254902},
		'276': {r: 0.168627450980392, g: 0.129411764705882, b: 0.27843137254902},
		'2765': {r: 0.168627450980392, g: 0.0470588235294118, b: 0.337254901960784},
		'2766': {r: 0.168627450980392, g: 0.149019607843137, b: 0.356862745098039},
		'2767': {r: 0.0784313725490196, g: 0.129411764705882, b: 0.23921568627451},
		'2768': {r: 0.0666666666666667, g: 0.129411764705882, b: 0.317647058823529},
		'277': {r: 0.709803921568627, g: 0.819607843137255, b: 0.909803921568627},
		'278': {r: 0.6, g: 0.729411764705882, b: 0.866666666666667},
		'279': {r: 0.4, g: 0.537254901960784, b: 0.8},
		'280': {r: 0, g: 0.168627450980392, b: 0.498039215686275},
		'281': {r: 0, g: 0.156862745098039, b: 0.407843137254902},
		'282': {r: 0, g: 0.149019607843137, b: 0.329411764705882},
		'283': {r: 0.607843137254902, g: 0.768627450980392, b: 0.886274509803922},
		'284': {r: 0.458823529411765, g: 0.666666666666667, b: 0.858823529411765},
		'285': {r: 0.227450980392157, g: 0.458823529411765, b: 0.768627450980392},
		'286': {r: 0, g: 0.219607843137255, b: 0.658823529411765},
		'287': {r: 0, g: 0.219607843137255, b: 0.576470588235294},
		'288': {r: 0, g: 0.2, b: 0.498039215686275},
		'289': {r: 0, g: 0.149019607843137, b: 0.286274509803922},
		'290': {r: 0.768627450980392, g: 0.847058823529412, b: 0.886274509803922},
		'2905': {r: 0.576470588235294, g: 0.776470588235294, b: 0.87843137254902},
		'291': {r: 0.658823529411765, g: 0.807843137254902, b: 0.886274509803922},
		'2915': {r: 0.376470588235294, g: 0.686274509803922, b: 0.866666666666667},
		'292': {r: 0.458823529411765, g: 0.698039215686274, b: 0.866666666666667},
		'2925': {r: 0, g: 0.556862745098039, b: 0.83921568627451},
		'293': {r: 0, g: 0.317647058823529, b: 0.729411764705882},
		'2935': {r: 0, g: 0.356862745098039, b: 0.749019607843137},
		'294': {r: 0, g: 0.247058823529412, b: 0.529411764705882},
		'2945': {r: 0, g: 0.329411764705882, b: 0.627450980392157},
		'295': {r: 0, g: 0.219607843137255, b: 0.419607843137255},
		'2955': {r: 0, g: 0.23921568627451, b: 0.419607843137255},
		'296': {r: 0, g: 0.176470588235294, b: 0.27843137254902},
		'2965': {r: 0, g: 0.2, b: 0.298039215686275},
		'297': {r: 0.509803921568627, g: 0.776470588235294, b: 0.886274509803922},
		'2975': {r: 0.729411764705882, g: 0.87843137254902, b: 0.886274509803922},
		'298': {r: 0.317647058823529, g: 0.709803921568627, b: 0.87843137254902},
		'2985': {r: 0.317647058823529, g: 0.749019607843137, b: 0.886274509803922},
		'299': {r: 0, g: 0.63921568627451, b: 0.866666666666667},
		'2995': {r: 0, g: 0.647058823529412, b: 0.858823529411765},
		'300': {r: 0, g: 0.447058823529412, b: 0.776470588235294},
		'3005': {r: 0, g: 0.517647058823529, b: 0.788235294117647},
		'301': {r: 0, g: 0.356862745098039, b: 0.6},
		'3015': {r: 0, g: 0.43921568627451, b: 0.619607843137255},
		'302': {r: 0, g: 0.309803921568627, b: 0.427450980392157},
		'3025': {r: 0, g: 0.329411764705882, b: 0.419607843137255},
		'303': {r: 0, g: 0.247058823529412, b: 0.329411764705882},
		'3035': {r: 0, g: 0.266666666666667, b: 0.329411764705882},
		'304': {r: 0.647058823529412, g: 0.866666666666667, b: 0.886274509803922},
		'305': {r: 0.43921568627451, g: 0.807843137254902, b: 0.886274509803922},
		'306': {r: 0, g: 0.737254901960784, b: 0.886274509803922},
		'306 2X': {r: 0, g: 0.63921568627451, b: 0.819607843137255},
		'307': {r: 0, g: 0.47843137254902, b: 0.647058823529412},
		'308': {r: 0, g: 0.376470588235294, b: 0.486274509803922},
		'309': {r: 0, g: 0.247058823529412, b: 0.286274509803922},
		'310': {r: 0.447058823529412, g: 0.819607843137255, b: 0.866666666666667},
		'3105': {r: 0.498039215686275, g: 0.83921568627451, b: 0.858823529411765},
		'311': {r: 0.156862745098039, g: 0.768627450980392, b: 0.847058823529412},
		'3115': {r: 0.176470588235294, g: 0.776470588235294, b: 0.83921568627451},
		'312': {r: 0, g: 0.67843137254902, b: 0.776470588235294},
		'3125': {r: 0, g: 0.717647058823529, b: 0.776470588235294},
		'313': {r: 0, g: 0.6, b: 0.709803921568627},
		'3135': {r: 0, g: 0.607843137254902, b: 0.666666666666667},
		'314': {r: 0, g: 0.509803921568627, b: 0.607843137254902},
		'3145': {r: 0, g: 0.517647058823529, b: 0.556862745098039},
		'315': {r: 0, g: 0.419607843137255, b: 0.466666666666667},
		'3155': {r: 0, g: 0.427450980392157, b: 0.458823529411765},
		'316': {r: 0, g: 0.286274509803922, b: 0.309803921568627},
		'3165': {r: 0, g: 0.337254901960784, b: 0.356862745098039},
		'317': {r: 0.788235294117647, g: 0.909803921568627, b: 0.866666666666667},
		'318': {r: 0.576470588235294, g: 0.866666666666667, b: 0.858823529411765},
		'319': {r: 0.298039215686275, g: 0.807843137254902, b: 0.819607843137255},
		'320': {r: 0, g: 0.619607843137255, b: 0.627450980392157},
		'320 2X': {r: 0, g: 0.498039215686275, b: 0.509803921568627},
		'321': {r: 0, g: 0.529411764705882, b: 0.537254901960784},
		'322': {r: 0, g: 0.447058823529412, b: 0.447058823529412},
		'323': {r: 0, g: 0.4, b: 0.388235294117647},
		'324': {r: 0.666666666666667, g: 0.866666666666667, b: 0.83921568627451},
		'3242': {r: 0.529411764705882, g: 0.866666666666667, b: 0.819607843137255},
		'3245': {r: 0.549019607843137, g: 0.87843137254902, b: 0.819607843137255},
		'3248': {r: 0.47843137254902, g: 0.827450980392157, b: 0.756862745098039},
		'325': {r: 0.337254901960784, g: 0.788235294117647, b: 0.756862745098039},
		'3252': {r: 0.337254901960784, g: 0.83921568627451, b: 0.788235294117647},
		'3255': {r: 0.27843137254902, g: 0.83921568627451, b: 0.756862745098039},
		'3258': {r: 0.207843137254902, g: 0.768627450980392, b: 0.686274509803922},
		'326': {r: 0, g: 0.698039215686274, b: 0.666666666666667},
		'3262': {r: 0, g: 0.756862745098039, b: 0.709803921568627},
		'3265': {r: 0, g: 0.776470588235294, b: 0.698039215686274},
		'3268': {r: 0, g: 0.686274509803922, b: 0.6},
		'327': {r: 0, g: 0.549019607843137, b: 0.509803921568627},
		'327 2X': {r: 0, g: 0.537254901960784, b: 0.466666666666667},
		'3272': {r: 0, g: 0.666666666666667, b: 0.619607843137255},
		'3275': {r: 0, g: 0.698039215686274, b: 0.627450980392157},
		'3278': {r: 0, g: 0.607843137254902, b: 0.517647058823529},
		'328': {r: 0, g: 0.466666666666667, b: 0.43921568627451},
		'3282': {r: 0, g: 0.549019607843137, b: 0.509803921568627},
		'3285': {r: 0, g: 0.6, b: 0.529411764705882},
		'3288': {r: 0, g: 0.509803921568627, b: 0.43921568627451},
		'329': {r: 0, g: 0.427450980392157, b: 0.4},
		'3292': {r: 0, g: 0.376470588235294, b: 0.337254901960784},
		'3295': {r: 0, g: 0.509803921568627, b: 0.447058823529412},
		'3298': {r: 0, g: 0.419607843137255, b: 0.356862745098039},
		'330': {r: 0, g: 0.349019607843137, b: 0.317647058823529},
		'3302': {r: 0, g: 0.286274509803922, b: 0.247058823529412},
		'3305': {r: 0, g: 0.309803921568627, b: 0.258823529411765},
		'3308': {r: 0, g: 0.266666666666667, b: 0.219607843137255},
		'331': {r: 0.729411764705882, g: 0.917647058823529, b: 0.83921568627451},
		'332': {r: 0.627450980392157, g: 0.898039215686275, b: 0.807843137254902},
		'333': {r: 0.368627450980392, g: 0.866666666666667, b: 0.756862745098039},
		'334': {r: 0, g: 0.6, b: 0.486274509803922},
		'335': {r: 0, g: 0.486274509803922, b: 0.4},
		'336': {r: 0, g: 0.407843137254902, b: 0.329411764705882},
		'337': {r: 0.607843137254902, g: 0.858823529411765, b: 0.756862745098039},
		'3375': {r: 0.556862745098039, g: 0.886274509803922, b: 0.737254901960784},
		'338': {r: 0.47843137254902, g: 0.819607843137255, b: 0.709803921568627},
		'3385': {r: 0.329411764705882, g: 0.847058823529412, b: 0.658823529411765},
		'339': {r: 0, g: 0.698039215686274, b: 0.549019607843137},
		'3395': {r: 0, g: 0.788235294117647, b: 0.576470588235294},
		'340': {r: 0, g: 0.6, b: 0.466666666666667},
		'3405': {r: 0, g: 0.698039215686274, b: 0.47843137254902},
		'341': {r: 0, g: 0.47843137254902, b: 0.368627450980392},
		'3415': {r: 0, g: 0.486274509803922, b: 0.349019607843137},
		'342': {r: 0, g: 0.419607843137255, b: 0.329411764705882},
		'3425': {r: 0, g: 0.407843137254902, b: 0.27843137254902},
		'343': {r: 0, g: 0.337254901960784, b: 0.247058823529412},
		'3435': {r: 0.00784313725490196, g: 0.286274509803922, b: 0.188235294117647},
		'344': {r: 0.709803921568627, g: 0.886274509803922, b: 0.749019607843137},
		'345': {r: 0.588235294117647, g: 0.847058823529412, b: 0.686274509803922},
		'346': {r: 0.43921568627451, g: 0.807843137254902, b: 0.607843137254902},
		'347': {r: 0, g: 0.619607843137255, b: 0.376470588235294},
		'348': {r: 0, g: 0.529411764705882, b: 0.317647058823529},
		'349': {r: 0, g: 0.419607843137255, b: 0.247058823529412},
		'350': {r: 0.137254901960784, g: 0.309803921568627, b: 0.2},
		'351': {r: 0.709803921568627, g: 0.909803921568627, b: 0.749019607843137},
		'352': {r: 0.6, g: 0.898039215686275, b: 0.698039215686274},
		'353': {r: 0.517647058823529, g: 0.886274509803922, b: 0.658823529411765},
		'354': {r: 0, g: 0.717647058823529, b: 0.376470588235294},
		'355': {r: 0, g: 0.619607843137255, b: 0.286274509803922},
		'356': {r: 0, g: 0.47843137254902, b: 0.23921568627451},
		'357': {r: 0.129411764705882, g: 0.356862745098039, b: 0.2},
		'358': {r: 0.666666666666667, g: 0.866666666666667, b: 0.588235294117647},
		'359': {r: 0.627450980392157, g: 0.858823529411765, b: 0.556862745098039},
		'360': {r: 0.376470588235294, g: 0.776470588235294, b: 0.349019607843137},
		'361': {r: 0.117647058823529, g: 0.709803921568627, b: 0.227450980392157},
		'362': {r: 0.2, g: 0.619607843137255, b: 0.207843137254902},
		'363': {r: 0.23921568627451, g: 0.556862745098039, b: 0.2},
		'364': {r: 0.227450980392157, g: 0.466666666666667, b: 0.156862745098039},
		'365': {r: 0.827450980392157, g: 0.909803921568627, b: 0.63921568627451},
		'366': {r: 0.768627450980392, g: 0.898039215686275, b: 0.556862745098039},
		'367': {r: 0.666666666666667, g: 0.866666666666667, b: 0.427450980392157},
		'368': {r: 0.356862745098039, g: 0.749019607843137, b: 0.129411764705882},
		'368 2X': {r: 0, g: 0.619607843137255, b: 0.0588235294117647},
		'369': {r: 0.337254901960784, g: 0.666666666666667, b: 0.109803921568627},
		'370': {r: 0.337254901960784, g: 0.556862745098039, b: 0.0784313725490196},
		'371': {r: 0.337254901960784, g: 0.419607843137255, b: 0.129411764705882},
		'372': {r: 0.847058823529412, g: 0.929411764705882, b: 0.588235294117647},
		'373': {r: 0.807843137254902, g: 0.917647058823529, b: 0.509803921568627},
		'374': {r: 0.729411764705882, g: 0.909803921568627, b: 0.376470588235294},
		'375': {r: 0.549019607843137, g: 0.83921568627451, b: 0},
		'375 2X': {r: 0.329411764705882, g: 0.737254901960784, b: 0},
		'376': {r: 0.498039215686275, g: 0.729411764705882, b: 0},
		'377': {r: 0.43921568627451, g: 0.576470588235294, b: 0.00784313725490196},
		'378': {r: 0.337254901960784, g: 0.388235294117647, b: 0.0784313725490196},
		'379': {r: 0.87843137254902, g: 0.917647058823529, b: 0.407843137254902},
		'380': {r: 0.83921568627451, g: 0.898039215686275, b: 0.258823529411765},
		'381': {r: 0.8, g: 0.886274509803922, b: 0.149019607843137},
		'382': {r: 0.729411764705882, g: 0.847058823529412, b: 0.0392156862745098},
		'382 2X': {r: 0.619607843137255, g: 0.768627450980392, b: 0},
		'383': {r: 0.63921568627451, g: 0.686274509803922, b: 0.0274509803921569},
		'384': {r: 0.576470588235294, g: 0.6, b: 0.0096078431372549},
		'385': {r: 0.43921568627451, g: 0.43921568627451, b: 0.0784313725490196},
		'386': {r: 0.909803921568627, g: 0.929411764705882, b: 0.376470588235294},
		'387': {r: 0.87843137254902, g: 0.929411764705882, b: 0.266666666666667},
		'388': {r: 0.83921568627451, g: 0.909803921568627, b: 0.0588235294117647},
		'389': {r: 0.807843137254902, g: 0.87843137254902, b: 0.0274509803921569},
		'390': {r: 0.729411764705882, g: 0.768627450980392, b: 0.0096078431372549},
		'391': {r: 0.619607843137255, g: 0.619607843137255, b: 0.0274509803921569},
		'392': {r: 0.517647058823529, g: 0.509803921568627, b: 0.0096078431372549},
		'393': {r: 0.949019607843137, g: 0.937254901960784, b: 0.529411764705882},
		'3935': {r: 0.949019607843137, g: 0.929411764705882, b: 0.427450980392157},
		'394': {r: 0.917647058823529, g: 0.929411764705882, b: 0.207843137254902},
		'3945': {r: 0.937254901960784, g: 0.917647058823529, b: 0.0274509803921569},
		'395': {r: 0.898039215686275, g: 0.909803921568627, b: 0.0666666666666667},
		'3955': {r: 0.929411764705882, g: 0.886274509803922, b: 0.0666666666666667},
		'396': {r: 0.87843137254902, g: 0.886274509803922, b: 0.0470588235294118},
		'3965': {r: 0.909803921568627, g: 0.866666666666667, b: 0.0666666666666667},
		'397': {r: 0.756862745098039, g: 0.749019607843137, b: 0.0392156862745098},
		'3975': {r: 0.709803921568627, g: 0.658823529411765, b: 0.0470588235294118},
		'398': {r: 0.686274509803922, g: 0.658823529411765, b: 0.0392156862745098},
		'3985': {r: 0.6, g: 0.549019607843137, b: 0.0392156862745098},
		'399': {r: 0.6, g: 0.556862745098039, b: 0.0274509803921569},
		'3995': {r: 0.427450980392157, g: 0.376470588235294, b: 0.00784313725490196},
		'400': {r: 0.819607843137255, g: 0.776470588235294, b: 0.709803921568627},
		'401': {r: 0.756862745098039, g: 0.709803921568627, b: 0.647058823529412},
		'402': {r: 0.686274509803922, g: 0.647058823529412, b: 0.576470588235294},
		'403': {r: 0.6, g: 0.549019607843137, b: 0.486274509803922},
		'404': {r: 0.509803921568627, g: 0.458823529411765, b: 0.4},
		'405': {r: 0.419607843137255, g: 0.368627450980392, b: 0.309803921568627},
		'406': {r: 0.807843137254902, g: 0.756862745098039, b: 0.709803921568627},
		'408': {r: 0.658823529411765, g: 0.6, b: 0.549019607843137},
		'409': {r: 0.6, g: 0.537254901960784, b: 0.486274509803922},
		'410': {r: 0.486274509803922, g: 0.427450980392157, b: 0.388235294117647},
		'411': {r: 0.4, g: 0.349019607843137, b: 0.298039215686275},
		'412': {r: 0.23921568627451, g: 0.188235294117647, b: 0.156862745098039},
		'413': {r: 0.776470588235294, g: 0.756862745098039, b: 0.698039215686274},
		'414': {r: 0.709803921568627, g: 0.686274509803922, b: 0.627450980392157},
		'415': {r: 0.63921568627451, g: 0.619607843137255, b: 0.549019607843137},
		'416': {r: 0.556862745098039, g: 0.549019607843137, b: 0.47843137254902},
		'417': {r: 0.466666666666667, g: 0.447058823529412, b: 0.388235294117647},
		'418': {r: 0.376470588235294, g: 0.368627450980392, b: 0.309803921568627},
		'419': {r: 0.156862745098039, g: 0.156862745098039, b: 0.129411764705882},
		'420': {r: 0.819607843137255, g: 0.8, b: 0.749019607843137},
		'421': {r: 0.749019607843137, g: 0.729411764705882, b: 0.686274509803922},
		'422': {r: 0.686274509803922, g: 0.666666666666667, b: 0.63921568627451},
		'423': {r: 0.588235294117647, g: 0.576470588235294, b: 0.556862745098039},
		'424': {r: 0.509803921568627, g: 0.498039215686275, b: 0.466666666666667},
		'425': {r: 0.376470588235294, g: 0.376470588235294, b: 0.356862745098039},
		'426': {r: 0.168627450980392, g: 0.168627450980392, b: 0.156862745098039},
		'427': {r: 0.866666666666667, g: 0.858823529411765, b: 0.819607843137255},
		'428': {r: 0.819607843137255, g: 0.807843137254902, b: 0.776470588235294},
		'429': {r: 0.67843137254902, g: 0.686274509803922, b: 0.666666666666667},
		'430': {r: 0.568627450980392, g: 0.588235294117647, b: 0.576470588235294},
		'431': {r: 0.4, g: 0.427450980392157, b: 0.43921568627451},
		'432': {r: 0.266666666666667, g: 0.309803921568627, b: 0.317647058823529},
		'433': {r: 0.188235294117647, g: 0.219607843137255, b: 0.227450980392157},
		'433 2X': {r: 0.0392156862745098, g: 0.0470588235294118, b: 0.0666666666666667},
		'434': {r: 0.87843137254902, g: 0.819607843137255, b: 0.776470588235294},
		'435': {r: 0.827450980392157, g: 0.749019607843137, b: 0.717647058823529},
		'436': {r: 0.737254901960784, g: 0.647058823529412, b: 0.619607843137255},
		'437': {r: 0.549019607843137, g: 0.43921568627451, b: 0.419607843137255},
		'438': {r: 0.349019607843137, g: 0.247058823529412, b: 0.23921568627451},
		'439': {r: 0.286274509803922, g: 0.207843137254902, b: 0.2},
		'440': {r: 0.247058823529412, g: 0.188235294117647, b: 0.168627450980392},
		'441': {r: 0.819607843137255, g: 0.819607843137255, b: 0.776470588235294},
		'442': {r: 0.729411764705882, g: 0.749019607843137, b: 0.717647058823529},
		'443': {r: 0.63921568627451, g: 0.658823529411765, b: 0.63921568627451},
		'444': {r: 0.537254901960784, g: 0.556862745098039, b: 0.549019607843137},
		'445': {r: 0.337254901960784, g: 0.349019607843137, b: 0.349019607843137},
		'446': {r: 0.286274509803922, g: 0.298039215686275, b: 0.286274509803922},
		'447': {r: 0.247058823529412, g: 0.247058823529412, b: 0.219607843137255},
		'448': {r: 0.329411764705882, g: 0.27843137254902, b: 0.176470588235294},
		'4485': {r: 0.376470588235294, g: 0.298039215686275, b: 0.0666666666666667},
		'449': {r: 0.329411764705882, g: 0.27843137254902, b: 0.149019607843137},
		'4495': {r: 0.529411764705882, g: 0.458823529411765, b: 0.188235294117647},
		'450': {r: 0.376470588235294, g: 0.329411764705882, b: 0.168627450980392},
		'4505': {r: 0.627450980392157, g: 0.568627450980392, b: 0.317647058823529},
		'451': {r: 0.67843137254902, g: 0.627450980392157, b: 0.47843137254902},
		'4515': {r: 0.737254901960784, g: 0.67843137254902, b: 0.458823529411765},
		'452': {r: 0.768627450980392, g: 0.717647058823529, b: 0.588235294117647},
		'4525': {r: 0.8, g: 0.749019607843137, b: 0.556862745098039},
		'453': {r: 0.83921568627451, g: 0.8, b: 0.686274509803922},
		'4535': {r: 0.858823529411765, g: 0.807843137254902, b: 0.647058823529412},
		'454': {r: 0.886274509803922, g: 0.847058823529412, b: 0.749019607843137},
		'4545': {r: 0.898039215686275, g: 0.858823529411765, b: 0.729411764705882},
		'455': {r: 0.4, g: 0.337254901960784, b: 0.0784313725490196},
		'456': {r: 0.6, g: 0.529411764705882, b: 0.0784313725490196},
		'457': {r: 0.709803921568627, g: 0.607843137254902, b: 0.0470588235294118},
		'458': {r: 0.866666666666667, g: 0.8, b: 0.419607843137255},
		'459': {r: 0.886274509803922, g: 0.83921568627451, b: 0.486274509803922},
		'460': {r: 0.917647058823529, g: 0.866666666666667, b: 0.588235294117647},
		'461': {r: 0.929411764705882, g: 0.898039215686275, b: 0.67843137254902},
		'462': {r: 0.356862745098039, g: 0.27843137254902, b: 0.137254901960784},
		'4625': {r: 0.27843137254902, g: 0.137254901960784, b: 0.0666666666666667},
		'463': {r: 0.458823529411765, g: 0.329411764705882, b: 0.149019607843137},
		'4635': {r: 0.549019607843137, g: 0.349019607843137, b: 0.2},
		'464': {r: 0.529411764705882, g: 0.376470588235294, b: 0.156862745098039},
		'464 2X': {r: 0.43921568627451, g: 0.258823529411765, b: 0.0784313725490196},
		'4645': {r: 0.698039215686274, g: 0.509803921568627, b: 0.376470588235294},
		'465': {r: 0.756862745098039, g: 0.658823529411765, b: 0.458823529411765},
		'4655': {r: 0.768627450980392, g: 0.6, b: 0.466666666666667},
		'466': {r: 0.819607843137255, g: 0.749019607843137, b: 0.568627450980392},
		'4665': {r: 0.847058823529412, g: 0.709803921568627, b: 0.588235294117647},
		'467': {r: 0.866666666666667, g: 0.8, b: 0.647058823529412},
		'4675': {r: 0.898039215686275, g: 0.776470588235294, b: 0.666666666666667},
		'468': {r: 0.886274509803922, g: 0.83921568627451, b: 0.709803921568627},
		'4685': {r: 0.929411764705882, g: 0.827450980392157, b: 0.737254901960784},
		'469': {r: 0.376470588235294, g: 0.2, b: 0.0666666666666667},
		'4695': {r: 0.317647058823529, g: 0.149019607843137, b: 0.109803921568627},
		'470': {r: 0.607843137254902, g: 0.309803921568627, b: 0.0980392156862745},
		'4705': {r: 0.486274509803922, g: 0.317647058823529, b: 0.23921568627451},
		'471': {r: 0.737254901960784, g: 0.368627450980392, b: 0.117647058823529},
		'471 2X': {r: 0.63921568627451, g: 0.266666666666667, b: 0.00784313725490196},
		'4715': {r: 0.6, g: 0.43921568627451, b: 0.356862745098039},
		'472': {r: 0.917647058823529, g: 0.666666666666667, b: 0.47843137254902},
		'4725': {r: 0.709803921568627, g: 0.568627450980392, b: 0.486274509803922},
		'473': {r: 0.956862745098039, g: 0.768627450980392, b: 0.627450980392157},
		'4735': {r: 0.8, g: 0.686274509803922, b: 0.607843137254902},
		'474': {r: 0.956862745098039, g: 0.8, b: 0.666666666666667},
		'4745': {r: 0.847058823529412, g: 0.749019607843137, b: 0.666666666666667},
		'475': {r: 0.968627450980392, g: 0.827450980392157, b: 0.709803921568627},
		'4755': {r: 0.886274509803922, g: 0.8, b: 0.729411764705882},
		'476': {r: 0.349019607843137, g: 0.23921568627451, b: 0.168627450980392},
		'477': {r: 0.388235294117647, g: 0.219607843137255, b: 0.149019607843137},
		'478': {r: 0.47843137254902, g: 0.247058823529412, b: 0.156862745098039},
		'479': {r: 0.686274509803922, g: 0.537254901960784, b: 0.43921568627451},
		'480': {r: 0.827450980392157, g: 0.717647058823529, b: 0.63921568627451},
		'481': {r: 0.87843137254902, g: 0.8, b: 0.729411764705882},
		'482': {r: 0.898039215686275, g: 0.827450980392157, b: 0.756862745098039},
		'483': {r: 0.419607843137255, g: 0.188235294117647, b: 0.129411764705882},
		'484': {r: 0.607843137254902, g: 0.188235294117647, b: 0.109803921568627},
		'485': {r: 0.847058823529412, g: 0.117647058823529, b: 0.0096078431372549},
		'485 2X': {r: 0.8, g: 0.0470588235294118, b: 0},
		'486': {r: 0.929411764705882, g: 0.619607843137255, b: 0.517647058823529},
		'487': {r: 0.937254901960784, g: 0.709803921568627, b: 0.627450980392157},
		'488': {r: 0.949019607843137, g: 0.768627450980392, b: 0.686274509803922},
		'489': {r: 0.949019607843137, g: 0.819607843137255, b: 0.749019607843137},
		'490': {r: 0.356862745098039, g: 0.149019607843137, b: 0.149019607843137},
		'491': {r: 0.458823529411765, g: 0.156862745098039, b: 0.156862745098039},
		'492': {r: 0.568627450980392, g: 0.2, b: 0.219607843137255},
		'494': {r: 0.949019607843137, g: 0.67843137254902, b: 0.698039215686274},
		'495': {r: 0.956862745098039, g: 0.737254901960784, b: 0.749019607843137},
		'496': {r: 0.968627450980392, g: 0.788235294117647, b: 0.776470588235294},
		'497': {r: 0.317647058823529, g: 0.156862745098039, b: 0.149019607843137},
		'4975': {r: 0.266666666666667, g: 0.117647058823529, b: 0.109803921568627},
		'498': {r: 0.427450980392157, g: 0.2, b: 0.168627450980392},
		'4985': {r: 0.517647058823529, g: 0.286274509803922, b: 0.286274509803922},
		'499': {r: 0.47843137254902, g: 0.219607843137255, b: 0.176470588235294},
		'4995': {r: 0.647058823529412, g: 0.419607843137255, b: 0.427450980392157},
		'500': {r: 0.807843137254902, g: 0.537254901960784, b: 0.549019607843137},
		'5005': {r: 0.737254901960784, g: 0.529411764705882, b: 0.529411764705882},
		'501': {r: 0.917647058823529, g: 0.698039215686274, b: 0.698039215686274},
		'5015': {r: 0.847058823529412, g: 0.67843137254902, b: 0.658823529411765},
		'502': {r: 0.949019607843137, g: 0.776470588235294, b: 0.768627450980392},
		'5025': {r: 0.886274509803922, g: 0.737254901960784, b: 0.717647058823529},
		'503': {r: 0.956862745098039, g: 0.819607843137255, b: 0.8},
		'5035': {r: 0.929411764705882, g: 0.807843137254902, b: 0.776470588235294},
		'504': {r: 0.317647058823529, g: 0.117647058823529, b: 0.149019607843137},
		'505': {r: 0.4, g: 0.117647058823529, b: 0.168627450980392},
		'506': {r: 0.47843137254902, g: 0.149019607843137, b: 0.219607843137255},
		'507': {r: 0.847058823529412, g: 0.537254901960784, b: 0.607843137254902},
		'508': {r: 0.909803921568627, g: 0.647058823529412, b: 0.686274509803922},
		'509': {r: 0.949019607843137, g: 0.729411764705882, b: 0.749019607843137},
		'510': {r: 0.956862745098039, g: 0.776470588235294, b: 0.788235294117647},
		'511': {r: 0.376470588235294, g: 0.129411764705882, b: 0.266666666666667},
		'5115': {r: 0.309803921568627, g: 0.129411764705882, b: 0.227450980392157},
		'512': {r: 0.517647058823529, g: 0.129411764705882, b: 0.419607843137255},
		'5125': {r: 0.458823529411765, g: 0.27843137254902, b: 0.376470588235294},
		'513': {r: 0.619607843137255, g: 0.137254901960784, b: 0.529411764705882},
		'5135': {r: 0.576470588235294, g: 0.419607843137255, b: 0.498039215686275},
		'514': {r: 0.847058823529412, g: 0.517647058823529, b: 0.737254901960784},
		'5145': {r: 0.67843137254902, g: 0.529411764705882, b: 0.6},
		'515': {r: 0.909803921568627, g: 0.63921568627451, b: 0.788235294117647},
		'5155': {r: 0.8, g: 0.686274509803922, b: 0.717647058823529},
		'516': {r: 0.949019607843137, g: 0.729411764705882, b: 0.827450980392157},
		'5165': {r: 0.87843137254902, g: 0.788235294117647, b: 0.8},
		'517': {r: 0.956862745098039, g: 0.8, b: 0.847058823529412},
		'5175': {r: 0.909803921568627, g: 0.83921568627451, b: 0.819607843137255},
		'518': {r: 0.317647058823529, g: 0.176470588235294, b: 0.266666666666667},
		'5185': {r: 0.27843137254902, g: 0.156862745098039, b: 0.207843137254902},
		'519': {r: 0.388235294117647, g: 0.188235294117647, b: 0.368627450980392},
		'5195': {r: 0.349019607843137, g: 0.2, b: 0.266666666666667},
		'520': {r: 0.43921568627451, g: 0.207843137254902, b: 0.447058823529412},
		'5205': {r: 0.556862745098039, g: 0.407843137254902, b: 0.466666666666667},
		'521': {r: 0.709803921568627, g: 0.549019607843137, b: 0.698039215686274},
		'5215': {r: 0.709803921568627, g: 0.576470588235294, b: 0.607843137254902},
		'522': {r: 0.776470588235294, g: 0.63921568627451, b: 0.756862745098039},
		'5225': {r: 0.8, g: 0.67843137254902, b: 0.686274509803922},
		'523': {r: 0.827450980392157, g: 0.717647058823529, b: 0.8},
		'5235': {r: 0.866666666666667, g: 0.776470588235294, b: 0.768627450980392},
		'524': {r: 0.886274509803922, g: 0.8, b: 0.827450980392157},
		'5245': {r: 0.898039215686275, g: 0.827450980392157, b: 0.8},
		'525': {r: 0.317647058823529, g: 0.149019607843137, b: 0.329411764705882},
		'5255': {r: 0.207843137254902, g: 0.149019607843137, b: 0.309803921568627},
		'526': {r: 0.407843137254902, g: 0.129411764705882, b: 0.47843137254902},
		'5265': {r: 0.286274509803922, g: 0.23921568627451, b: 0.388235294117647},
		'527': {r: 0.47843137254902, g: 0.117647058823529, b: 0.6},
		'5275': {r: 0.376470588235294, g: 0.337254901960784, b: 0.466666666666667},
		'528': {r: 0.686274509803922, g: 0.447058823529412, b: 0.756862745098039},
		'5285': {r: 0.549019607843137, g: 0.509803921568627, b: 0.6},
		'529': {r: 0.807843137254902, g: 0.63921568627451, b: 0.827450980392157},
		'5295': {r: 0.698039215686274, g: 0.658823529411765, b: 0.709803921568627},
		'530': {r: 0.83921568627451, g: 0.686274509803922, b: 0.83921568627451},
		'5305': {r: 0.8, g: 0.756862745098039, b: 0.776470588235294},
		'531': {r: 0.898039215686275, g: 0.776470588235294, b: 0.858823529411765},
		'5315': {r: 0.858823529411765, g: 0.827450980392157, b: 0.827450980392157},
		'532': {r: 0.207843137254902, g: 0.219607843137255, b: 0.258823529411765},
		'533': {r: 0.207843137254902, g: 0.247058823529412, b: 0.356862745098039},
		'534': {r: 0.227450980392157, g: 0.286274509803922, b: 0.447058823529412},
		'535': {r: 0.607843137254902, g: 0.63921568627451, b: 0.717647058823529},
		'536': {r: 0.67843137254902, g: 0.698039215686274, b: 0.756862745098039},
		'537': {r: 0.768627450980392, g: 0.776470588235294, b: 0.807843137254902},
		'538': {r: 0.83921568627451, g: 0.827450980392157, b: 0.83921568627451},
		'539': {r: 0, g: 0.188235294117647, b: 0.286274509803922},
		'5395': {r: 0.00784313725490196, g: 0.156862745098039, b: 0.227450980392157},
		'540': {r: 0, g: 0.2, b: 0.356862745098039},
		'5405': {r: 0.247058823529412, g: 0.376470588235294, b: 0.458823529411765},
		'541': {r: 0, g: 0.247058823529412, b: 0.466666666666667},
		'5415': {r: 0.376470588235294, g: 0.486274509803922, b: 0.549019607843137},
		'542': {r: 0.4, g: 0.576470588235294, b: 0.737254901960784},
		'5425': {r: 0.517647058823529, g: 0.6, b: 0.647058823529412},
		'543': {r: 0.576470588235294, g: 0.717647058823529, b: 0.819607843137255},
		'5435': {r: 0.686274509803922, g: 0.737254901960784, b: 0.749019607843137},
		'544': {r: 0.717647058823529, g: 0.8, b: 0.858823529411765},
		'5445': {r: 0.768627450980392, g: 0.8, b: 0.8},
		'545': {r: 0.768627450980392, g: 0.827450980392157, b: 0.866666666666667},
		'5455': {r: 0.83921568627451, g: 0.847058823529412, b: 0.827450980392157},
		'546': {r: 0.0470588235294118, g: 0.219607843137255, b: 0.266666666666667},
		'5463': {r: 0, g: 0.207843137254902, b: 0.227450980392157},
		'5467': {r: 0.0980392156862745, g: 0.219607843137255, b: 0.2},
		'547': {r: 0, g: 0.247058823529412, b: 0.329411764705882},
		'5473': {r: 0.149019607843137, g: 0.407843137254902, b: 0.427450980392157},
		'5477': {r: 0.227450980392157, g: 0.337254901960784, b: 0.309803921568627},
		'548': {r: 0, g: 0.266666666666667, b: 0.349019607843137},
		'5483': {r: 0.376470588235294, g: 0.568627450980392, b: 0.568627450980392},
		'5487': {r: 0.4, g: 0.486274509803922, b: 0.447058823529412},
		'549': {r: 0.368627450980392, g: 0.6, b: 0.666666666666667},
		'5493': {r: 0.549019607843137, g: 0.686274509803922, b: 0.67843137254902},
		'5497': {r: 0.568627450980392, g: 0.63921568627451, b: 0.6},
		'550': {r: 0.529411764705882, g: 0.686274509803922, b: 0.749019607843137},
		'5503': {r: 0.666666666666667, g: 0.768627450980392, b: 0.749019607843137},
		'5507': {r: 0.686274509803922, g: 0.729411764705882, b: 0.698039215686274},
		'551': {r: 0.63921568627451, g: 0.756862745098039, b: 0.788235294117647},
		'5513': {r: 0.807843137254902, g: 0.847058823529412, b: 0.819607843137255},
		'5517': {r: 0.788235294117647, g: 0.807843137254902, b: 0.768627450980392},
		'552': {r: 0.768627450980392, g: 0.83921568627451, b: 0.83921568627451},
		'5523': {r: 0.83921568627451, g: 0.866666666666667, b: 0.83921568627451},
		'5527': {r: 0.807843137254902, g: 0.819607843137255, b: 0.776470588235294},
		'553': {r: 0.137254901960784, g: 0.266666666666667, b: 0.207843137254902},
		'5535': {r: 0.129411764705882, g: 0.23921568627451, b: 0.188235294117647},
		'554': {r: 0.0980392156862745, g: 0.368627450980392, b: 0.27843137254902},
		'5545': {r: 0.309803921568627, g: 0.427450980392157, b: 0.368627450980392},
		'555': {r: 0.0274509803921569, g: 0.427450980392157, b: 0.329411764705882},
		'5555': {r: 0.466666666666667, g: 0.568627450980392, b: 0.509803921568627},
		'556': {r: 0.47843137254902, g: 0.658823529411765, b: 0.568627450980392},
		'5565': {r: 0.588235294117647, g: 0.666666666666667, b: 0.6},
		'557': {r: 0.63921568627451, g: 0.756862745098039, b: 0.67843137254902},
		'5575': {r: 0.686274509803922, g: 0.749019607843137, b: 0.67843137254902},
		'558': {r: 0.717647058823529, g: 0.807843137254902, b: 0.737254901960784},
		'5585': {r: 0.768627450980392, g: 0.807843137254902, b: 0.749019607843137},
		'559': {r: 0.776470588235294, g: 0.83921568627451, b: 0.768627450980392},
		'5595': {r: 0.847058823529412, g: 0.858823529411765, b: 0.8},
		'560': {r: 0.168627450980392, g: 0.298039215686275, b: 0.247058823529412},
		'5605': {r: 0.137254901960784, g: 0.227450980392157, b: 0.176470588235294},
		'561': {r: 0.149019607843137, g: 0.4, b: 0.349019607843137},
		'5615': {r: 0.329411764705882, g: 0.407843137254902, b: 0.337254901960784},
		'562': {r: 0.117647058823529, g: 0.47843137254902, b: 0.427450980392157},
		'5625': {r: 0.447058823529412, g: 0.517647058823529, b: 0.43921568627451},
		'563': {r: 0.498039215686275, g: 0.737254901960784, b: 0.666666666666667},
		'5635': {r: 0.619607843137255, g: 0.666666666666667, b: 0.6},
		'564': {r: 0.0096078431372549, g: 0.43921568627451, b: 0.368627450980392},
		'5645': {r: 0.737254901960784, g: 0.756862745098039, b: 0.698039215686274},
		'565': {r: 0.737254901960784, g: 0.858823529411765, b: 0.8},
		'5655': {r: 0.776470588235294, g: 0.8, b: 0.729411764705882},
		'566': {r: 0.819607843137255, g: 0.886274509803922, b: 0.827450980392157},
		'5665': {r: 0.83921568627451, g: 0.83921568627451, b: 0.776470588235294},
		'567': {r: 0.149019607843137, g: 0.317647058823529, b: 0.258823529411765},
		'568': {r: 0, g: 0.447058823529412, b: 0.388235294117647},
		'569': {r: 0, g: 0.529411764705882, b: 0.447058823529412},
		'570': {r: 0.498039215686275, g: 0.776470588235294, b: 0.698039215686274},
		'571': {r: 0.666666666666667, g: 0.858823529411765, b: 0.776470588235294},
		'572': {r: 0.737254901960784, g: 0.886274509803922, b: 0.807843137254902},
		'573': {r: 0.8, g: 0.898039215686275, b: 0.83921568627451},
		'574': {r: 0.286274509803922, g: 0.349019607843137, b: 0.156862745098039},
		'5743': {r: 0.247058823529412, g: 0.286274509803922, b: 0.149019607843137},
		'5747': {r: 0.258823529411765, g: 0.27843137254902, b: 0.0862745098039216},
		'575': {r: 0.329411764705882, g: 0.466666666666667, b: 0.188235294117647},
		'5753': {r: 0.368627450980392, g: 0.4, b: 0.227450980392157},
		'5757': {r: 0.419607843137255, g: 0.43921568627451, b: 0.168627450980392},
		'576': {r: 0.376470588235294, g: 0.556862745098039, b: 0.227450980392157},
		'5763': {r: 0.466666666666667, g: 0.486274509803922, b: 0.309803921568627},
		'5767': {r: 0.549019607843137, g: 0.568627450980392, b: 0.309803921568627},
		'577': {r: 0.709803921568627, g: 0.8, b: 0.556862745098039},
		'5773': {r: 0.607843137254902, g: 0.619607843137255, b: 0.447058823529412},
		'5777': {r: 0.666666666666667, g: 0.67843137254902, b: 0.458823529411765},
		'578': {r: 0.776470588235294, g: 0.83921568627451, b: 0.627450980392157},
		'5783': {r: 0.709803921568627, g: 0.709803921568627, b: 0.556862745098039},
		'5787': {r: 0.776470588235294, g: 0.776470588235294, b: 0.6},
		'579': {r: 0.788235294117647, g: 0.83921568627451, b: 0.63921568627451},
		'5793': {r: 0.776470588235294, g: 0.776470588235294, b: 0.647058823529412},
		'5797': {r: 0.827450980392157, g: 0.819607843137255, b: 0.666666666666667},
		'580': {r: 0.847058823529412, g: 0.866666666666667, b: 0.709803921568627},
		'5803': {r: 0.847058823529412, g: 0.83921568627451, b: 0.717647058823529},
		'5807': {r: 0.87843137254902, g: 0.866666666666667, b: 0.737254901960784},
		'581': {r: 0.376470588235294, g: 0.368627450980392, b: 0.0666666666666667},
		'5815': {r: 0.286274509803922, g: 0.266666666666667, b: 0.0666666666666667},
		'582': {r: 0.529411764705882, g: 0.537254901960784, b: 0.0096078431372549},
		'5825': {r: 0.458823529411765, g: 0.43921568627451, b: 0.168627450980392},
		'583': {r: 0.666666666666667, g: 0.729411764705882, b: 0.0392156862745098},
		'5835': {r: 0.619607843137255, g: 0.6, b: 0.349019607843137},
		'584': {r: 0.807843137254902, g: 0.83921568627451, b: 0.286274509803922},
		'5845': {r: 0.698039215686274, g: 0.666666666666667, b: 0.43921568627451},
		'585': {r: 0.858823529411765, g: 0.87843137254902, b: 0.419607843137255},
		'5855': {r: 0.8, g: 0.776470588235294, b: 0.576470588235294},
		'586': {r: 0.886274509803922, g: 0.898039215686275, b: 0.517647058823529},
		'5865': {r: 0.83921568627451, g: 0.807843137254902, b: 0.63921568627451},
		'587': {r: 0.909803921568627, g: 0.909803921568627, b: 0.607843137254902},
		'5875': {r: 0.87843137254902, g: 0.858823529411765, b: 0.709803921568627},
		'600': {r: 0.956862745098039, g: 0.929411764705882, b: 0.686274509803922},
		'601': {r: 0.949019607843137, g: 0.929411764705882, b: 0.619607843137255},
		'602': {r: 0.949019607843137, g: 0.917647058823529, b: 0.529411764705882},
		'603': {r: 0.929411764705882, g: 0.909803921568627, b: 0.356862745098039},
		'604': {r: 0.909803921568627, g: 0.866666666666667, b: 0.129411764705882},
		'605': {r: 0.866666666666667, g: 0.807843137254902, b: 0.0666666666666667},
		'606': {r: 0.827450980392157, g: 0.749019607843137, b: 0.0666666666666667},
		'607': {r: 0.949019607843137, g: 0.917647058823529, b: 0.737254901960784},
		'608': {r: 0.937254901960784, g: 0.909803921568627, b: 0.67843137254902},
		'609': {r: 0.917647058823529, g: 0.898039215686275, b: 0.588235294117647},
		'610': {r: 0.886274509803922, g: 0.858823529411765, b: 0.447058823529412},
		'611': {r: 0.83921568627451, g: 0.807843137254902, b: 0.286274509803922},
		'612': {r: 0.768627450980392, g: 0.729411764705882, b: 0},
		'613': {r: 0.686274509803922, g: 0.627450980392157, b: 0.0470588235294118},
		'614': {r: 0.917647058823529, g: 0.886274509803922, b: 0.717647058823529},
		'615': {r: 0.886274509803922, g: 0.858823529411765, b: 0.666666666666667},
		'616': {r: 0.866666666666667, g: 0.83921568627451, b: 0.607843137254902},
		'617': {r: 0.8, g: 0.768627450980392, b: 0.486274509803922},
		'618': {r: 0.709803921568627, g: 0.666666666666667, b: 0.349019607843137},
		'619': {r: 0.588235294117647, g: 0.549019607843137, b: 0.156862745098039},
		'620': {r: 0.517647058823529, g: 0.466666666666667, b: 0.0666666666666667},
		'621': {r: 0.847058823529412, g: 0.866666666666667, b: 0.807843137254902},
		'622': {r: 0.756862745098039, g: 0.819607843137255, b: 0.749019607843137},
		'623': {r: 0.647058823529412, g: 0.749019607843137, b: 0.666666666666667},
		'624': {r: 0.498039215686275, g: 0.627450980392157, b: 0.549019607843137},
		'625': {r: 0.356862745098039, g: 0.529411764705882, b: 0.447058823529412},
		'626': {r: 0.129411764705882, g: 0.329411764705882, b: 0.247058823529412},
		'627': {r: 0.0470588235294118, g: 0.188235294117647, b: 0.149019607843137},
		'628': {r: 0.8, g: 0.886274509803922, b: 0.866666666666667},
		'629': {r: 0.698039215686274, g: 0.847058823529412, b: 0.847058823529412},
		'630': {r: 0.549019607843137, g: 0.8, b: 0.827450980392157},
		'631': {r: 0.329411764705882, g: 0.717647058823529, b: 0.776470588235294},
		'632': {r: 0, g: 0.627450980392157, b: 0.729411764705882},
		'633': {r: 0, g: 0.498039215686275, b: 0.6},
		'634': {r: 0, g: 0.4, b: 0.498039215686275},
		'635': {r: 0.729411764705882, g: 0.87843137254902, b: 0.87843137254902},
		'636': {r: 0.6, g: 0.83921568627451, b: 0.866666666666667},
		'637': {r: 0.419607843137255, g: 0.788235294117647, b: 0.858823529411765},
		'638': {r: 0, g: 0.709803921568627, b: 0.83921568627451},
		'639': {r: 0, g: 0.627450980392157, b: 0.768627450980392},
		'640': {r: 0, g: 0.549019607843137, b: 0.698039215686274},
		'641': {r: 0, g: 0.47843137254902, b: 0.647058823529412},
		'642': {r: 0.819607843137255, g: 0.847058823529412, b: 0.847058823529412},
		'643': {r: 0.776470588235294, g: 0.819607843137255, b: 0.83921568627451},
		'644': {r: 0.607843137254902, g: 0.686274509803922, b: 0.768627450980392},
		'645': {r: 0.466666666666667, g: 0.588235294117647, b: 0.698039215686274},
		'646': {r: 0.368627450980392, g: 0.509803921568627, b: 0.63921568627451},
		'647': {r: 0.149019607843137, g: 0.329411764705882, b: 0.486274509803922},
		'648': {r: 0, g: 0.188235294117647, b: 0.368627450980392},
		'649': {r: 0.83921568627451, g: 0.83921568627451, b: 0.847058823529412},
		'650': {r: 0.749019607843137, g: 0.776470588235294, b: 0.819607843137255},
		'651': {r: 0.607843137254902, g: 0.666666666666667, b: 0.749019607843137},
		'652': {r: 0.427450980392157, g: 0.529411764705882, b: 0.658823529411765},
		'653': {r: 0.2, g: 0.337254901960784, b: 0.529411764705882},
		'654': {r: 0.0588235294117647, g: 0.168627450980392, b: 0.356862745098039},
		'655': {r: 0.0470588235294118, g: 0.109803921568627, b: 0.27843137254902},
		'656': {r: 0.83921568627451, g: 0.858823529411765, b: 0.87843137254902},
		'657': {r: 0.756862745098039, g: 0.788235294117647, b: 0.866666666666667},
		'658': {r: 0.647058823529412, g: 0.686274509803922, b: 0.83921568627451},
		'659': {r: 0.498039215686275, g: 0.549019607843137, b: 0.749019607843137},
		'660': {r: 0.349019607843137, g: 0.376470588235294, b: 0.658823529411765},
		'661': {r: 0.176470588235294, g: 0.2, b: 0.556862745098039},
		'662': {r: 0.0470588235294118, g: 0.0980392156862745, b: 0.458823529411765},
		'663': {r: 0.886274509803922, g: 0.827450980392157, b: 0.83921568627451},
		'664': {r: 0.847058823529412, g: 0.8, b: 0.819607843137255},
		'665': {r: 0.776470588235294, g: 0.709803921568627, b: 0.768627450980392},
		'666': {r: 0.658823529411765, g: 0.576470588235294, b: 0.67843137254902},
		'667': {r: 0.498039215686275, g: 0.4, b: 0.537254901960784},
		'668': {r: 0.4, g: 0.286274509803922, b: 0.458823529411765},
		'669': {r: 0.27843137254902, g: 0.168627450980392, b: 0.349019607843137},
		'670': {r: 0.949019607843137, g: 0.83921568627451, b: 0.847058823529412},
		'671': {r: 0.937254901960784, g: 0.776470588235294, b: 0.827450980392157},
		'672': {r: 0.917647058823529, g: 0.666666666666667, b: 0.768627450980392},
		'673': {r: 0.87843137254902, g: 0.549019607843137, b: 0.698039215686274},
		'674': {r: 0.827450980392157, g: 0.419607843137255, b: 0.619607843137255},
		'675': {r: 0.737254901960784, g: 0.219607843137255, b: 0.466666666666667},
		'676': {r: 0.627450980392157, g: 0, b: 0.329411764705882},
		'677': {r: 0.929411764705882, g: 0.83921568627451, b: 0.83921568627451},
		'678': {r: 0.917647058823529, g: 0.8, b: 0.807843137254902},
		'679': {r: 0.898039215686275, g: 0.749019607843137, b: 0.776470588235294},
		'680': {r: 0.827450980392157, g: 0.619607843137255, b: 0.686274509803922},
		'681': {r: 0.717647058823529, g: 0.447058823529412, b: 0.556862745098039},
		'682': {r: 0.627450980392157, g: 0.317647058823529, b: 0.458823529411765},
		'683': {r: 0.498039215686275, g: 0.156862745098039, b: 0.309803921568627},
		'684': {r: 0.937254901960784, g: 0.8, b: 0.807843137254902},
		'685': {r: 0.917647058823529, g: 0.749019607843137, b: 0.768627450980392},
		'686': {r: 0.87843137254902, g: 0.666666666666667, b: 0.729411764705882},
		'687': {r: 0.788235294117647, g: 0.537254901960784, b: 0.619607843137255},
		'688': {r: 0.698039215686274, g: 0.4, b: 0.517647058823529},
		'689': {r: 0.576470588235294, g: 0.258823529411765, b: 0.4},
		'690': {r: 0.43921568627451, g: 0.137254901960784, b: 0.258823529411765},
		'691': {r: 0.937254901960784, g: 0.819607843137255, b: 0.788235294117647},
		'692': {r: 0.909803921568627, g: 0.749019607843137, b: 0.729411764705882},
		'693': {r: 0.858823529411765, g: 0.658823529411765, b: 0.647058823529412},
		'694': {r: 0.788235294117647, g: 0.549019607843137, b: 0.549019607843137},
		'695': {r: 0.698039215686274, g: 0.419607843137255, b: 0.43921568627451},
		'696': {r: 0.556862745098039, g: 0.27843137254902, b: 0.286274509803922},
		'697': {r: 0.498039215686275, g: 0.219607843137255, b: 0.227450980392157},
		'698': {r: 0.968627450980392, g: 0.819607843137255, b: 0.8},
		'699': {r: 0.968627450980392, g: 0.749019607843137, b: 0.749019607843137},
		'700': {r: 0.949019607843137, g: 0.647058823529412, b: 0.666666666666667},
		'701': {r: 0.909803921568627, g: 0.529411764705882, b: 0.556862745098039},
		'702': {r: 0.83921568627451, g: 0.376470588235294, b: 0.427450980392157},
		'703': {r: 0.717647058823529, g: 0.219607843137255, b: 0.266666666666667},
		'704': {r: 0.619607843137255, g: 0.156862745098039, b: 0.156862745098039},
		'705': {r: 0.976470588235294, g: 0.866666666666667, b: 0.83921568627451},
		'706': {r: 0.988235294117647, g: 0.788235294117647, b: 0.776470588235294},
		'707': {r: 0.988235294117647, g: 0.67843137254902, b: 0.686274509803922},
		'708': {r: 0.976470588235294, g: 0.556862745098039, b: 0.6},
		'709': {r: 0.949019607843137, g: 0.407843137254902, b: 0.466666666666667},
		'710': {r: 0.87843137254902, g: 0.258823529411765, b: 0.317647058823529},
		'711': {r: 0.819607843137255, g: 0.176470588235294, b: 0.2},
		'712': {r: 1, g: 0.827450980392157, b: 0.666666666666667},
		'713': {r: 0.976470588235294, g: 0.788235294117647, b: 0.63921568627451},
		'714': {r: 0.976470588235294, g: 0.729411764705882, b: 0.509803921568627},
		'715': {r: 0.988235294117647, g: 0.619607843137255, b: 0.286274509803922},
		'716': {r: 0.949019607843137, g: 0.517647058823529, b: 0.0666666666666667},
		'717': {r: 0.827450980392157, g: 0.427450980392157, b: 0},
		'718': {r: 0.749019607843137, g: 0.356862745098039, b: 0},
		'719': {r: 0.956862745098039, g: 0.819607843137255, b: 0.686274509803922},
		'720': {r: 0.937254901960784, g: 0.768627450980392, b: 0.619607843137255},
		'721': {r: 0.909803921568627, g: 0.698039215686274, b: 0.509803921568627},
		'722': {r: 0.819607843137255, g: 0.556862745098039, b: 0.329411764705882},
		'723': {r: 0.729411764705882, g: 0.458823529411765, b: 0.188235294117647},
		'724': {r: 0.556862745098039, g: 0.286274509803922, b: 0.0096078431372549},
		'725': {r: 0.458823529411765, g: 0.219607843137255, b: 0.00784313725490196},
		'726': {r: 0.929411764705882, g: 0.827450980392157, b: 0.709803921568627},
		'727': {r: 0.886274509803922, g: 0.749019607843137, b: 0.607843137254902},
		'728': {r: 0.827450980392157, g: 0.658823529411765, b: 0.486274509803922},
		'729': {r: 0.756862745098039, g: 0.556862745098039, b: 0.376470588235294},
		'730': {r: 0.666666666666667, g: 0.458823529411765, b: 0.247058823529412},
		'731': {r: 0.447058823529412, g: 0.247058823529412, b: 0.0392156862745098},
		'732': {r: 0.376470588235294, g: 0.2, b: 0.0392156862745098},
		'801': {r: 0, g: 0.666666666666667, b: 0.8},
		'801 2X': {r: 0, g: 0.537254901960784, b: 0.686274509803922},
		'802': {r: 0.376470588235294, g: 0.866666666666667, b: 0.286274509803922},
		'802 2X': {r: 0.109803921568627, g: 0.807843137254902, b: 0.156862745098039},
		'803': {r: 1, g: 0.929411764705882, b: 0.219607843137255},
		'803 2X': {r: 1, g: 0.847058823529412, b: 0.0862745098039216},
		'804': {r: 1, g: 0.576470588235294, b: 0.219607843137255},
		'804 2X': {r: 1, g: 0.498039215686275, b: 0.117647058823529},
		'805': {r: 0.976470588235294, g: 0.349019607843137, b: 0.317647058823529},
		'805 2X': {r: 0.976470588235294, g: 0.227450980392157, b: 0.168627450980392},
		'806': {r: 1, g: 0, b: 0.576470588235294},
		'806 2X': {r: 0.968627450980392, g: 0.00784313725490196, b: 0.486274509803922},
		'807': {r: 0.83921568627451, g: 0, b: 0.619607843137255},
		'807 2X': {r: 0.749019607843137, g: 0, b: 0.549019607843137},
		'808': {r: 0, g: 0.709803921568627, b: 0.607843137254902},
		'808 2X': {r: 0, g: 0.627450980392157, b: 0.529411764705882},
		'809': {r: 0.866666666666667, g: 0.87843137254902, b: 0.0588235294117647},
		'809 2X': {r: 0.83921568627451, g: 0.83921568627451, b: 0.0470588235294118},
		'810': {r: 1, g: 0.8, b: 0.117647058823529},
		'810 2X': {r: 1, g: 0.737254901960784, b: 0.129411764705882},
		'811': {r: 1, g: 0.447058823529412, b: 0.27843137254902},
		'811 2X': {r: 1, g: 0.329411764705882, b: 0.0862745098039216},
		'812': {r: 0.988235294117647, g: 0.137254901960784, b: 0.4},
		'812 2X': {r: 0.988235294117647, g: 0.0274509803921569, b: 0.309803921568627},
		'813': {r: 0.898039215686275, g: 0, b: 0.6},
		'813 2X': {r: 0.819607843137255, g: 0, b: 0.517647058823529},
		'814': {r: 0.549019607843137, g: 0.376470588235294, b: 0.756862745098039},
		'814 2X': {r: 0.43921568627451, g: 0.247058823529412, b: 0.686274509803922}
	};
});