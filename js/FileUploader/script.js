/**
 * FancyUpload Showcase
 *
 * @license		MIT License
 * @author		Harald Kirschner <mail [at] digitarald [dot] de>
 * @copyright	Authors
 */
var ajaxurl = window.siteurl + '/ajax.php';
var up;
var lastid=0;

function statusMessage(parent, text, options) {
	message = new Element('div',options);
	message.set('text', text);
	message.inject(parent, 'top');
	(function(){
		this.morph({opacity: 0, height:0, margin:0, padding:0});
    }).delay(3000, message);
}

function formatUnit(base, type, join) {
		var labels = Swiff.Uploader.unitLabels[(type == 'bps') ? 'b' : type];
		var append = (type == 'bps') ? '/s' : '';
		var i, l = labels.length, value;

		if (base < 1) return '0 ' + labels[0].unit + append;

		if (type == 's') {
			var units = [];

			for (i = l - 1; i >= 0; i--) {
				value = Math.floor(base / labels[i].min);
				if (value) {
					units.push(value + ' ' + labels[i].unit);
					base -= value * labels[i].min;
					if (!base) break;
				}
			}

			return (join === false) ? units : units.join(join || ', ');
		}

		for (i = l - 1; i >= 0; i--) {
			value = labels[i].min;
			if (base >= value) break;
		}

		return (base / value).toFixed(1) + ' ' + labels[i].unit + append;
	}

function getId(){
	return lastid++;
}

function createAjaxUpload(id){
	new AjaxUpload(id, {
		action: window.siteurl+'/fancy.php',
		name: 'Filedata',
		data: {
			response:'nojson'
		},
		autoSubmit: true,
		responseType: 'json',
		onSubmit: function(file, extension) {},
		onComplete: function(file, resp) {
			$('attach_list').setStyle('display', 'none');
			$('attach').setStyle('display', 'none');
			$('new_attach').setStyle('display', 'block');
			id = getId();
			ui = {};

			ui.tr = new Element('tr', {'class': 'filetr', id: 'tr-'+id});
			ui.commenttd = new Element('td',{id: 'commenttd-'+id});
			ui.element = new Element('td',{'class': 'file',id: 'filetd-'+id});
			
			ui.title = new Element('span', {'class': 'file-title', text: resp.name});
			ui.size = new Element('span', {'class': 'file-size', text: formatUnit(resp.size, 'b')});
			
			ui.element.adopt(
				ui.title,
				ui.size
			);
			ui.tr.adopt(
				ui.element,
				ui.commenttd
			).inject($('new-attach-list'));
			ui.tr.highlight();
			if (resp.status){
				new Element('input', {type: 'checkbox', 'checked': true, name: 'file['+id+'][save]'}).inject(ui.element, 'top');
				new Element('input', {type: 'hidden', value: resp.name, name: 'file['+id+'][filename]'}).inject(ui.element, 'top');
				new Element('input', {type: 'hidden', value: resp.src, name: 'file['+id+'][tmpname]'}).inject(ui.element, 'top');
				new Element('input', {type: 'hidden', value: ui.size.getText(), name: 'file['+id+'][size]'}).inject(ui.element, 'top');
				new Element('input', {type: 'text', 'style': 'width:100%;height:13px;line-height:11px;padding:0;', name: 'file['+id+'][comment]'}).inject(ui.commenttd);
				ui.element.highlight('#e6efc2');
			} else {
				this.OnFileError(file);
			}
		}
	});	
}
	
function createUploader(){
	if (Browser.Platform.linux) {
		createAjaxUpload('attach');
		createAjaxUpload('attach-2');
	}else{
		up = new FancyUpload3.Attach('new-attach-list', '#attach, #attach-2', {
			path: window.siteurl+'/js/FileUploader/Swiff.Uploader.swf',
			url: window.siteurl+'/fancy.php',
	 
			verbose: true,
	 
			onSelectFail: function(files) {
				files.each(function(file) {
					new Element('li', {
						'class': 'file-invalid',
						events: {
							click: function() {
								this.destroy();
							}
						}
					}).adopt(
						new Element('span', {html: file.validationErrorMessage || file.validationError})
					).inject(this.list, 'bottom');
				}, this);	
			},
	 
			onFileSuccess: function(file, resp) {
				resp = JSON.decode(resp);
				if (resp.status){
					new Element('input', {type: 'checkbox', 'checked': true, name: 'file['+file.id+'][save]'}).inject(file.ui.element, 'top');
					new Element('input', {type: 'hidden', value: resp.name, name: 'file['+file.id+'][filename]'}).inject(file.ui.element, 'top');
					new Element('input', {type: 'hidden', value: resp.src, name: 'file['+file.id+'][tmpname]'}).inject(file.ui.element, 'top');
					new Element('input', {type: 'hidden', value: file.ui.size.getText(), name: 'file['+file.id+'][size]'}).inject(file.ui.element, 'top');
					new Element('input', {type: 'text', 'style': 'width:100%;height:13px;line-height:11px;padding:0;', name: 'file['+file.id+'][comment]'}).inject(file.ui.commenttd);
					file.ui.element.highlight('#e6efc2');
				} else {
					this.OnFileError(file);
				}			
			},
	 
			onFileError: function(file) {
				file.ui.cancel.set('html', 'Retry').removeEvents().addEvent('click', function() {
					file.requeue();
					return false;
				});
	 
				new Element('span', {
					html: file.errorMessage,
					'class': 'file-error'
				}).inject(file.ui.cancel, 'after');
			},
	 
			onFileRequeue: function(file) {
				file.ui.element.getElement('.file-error').destroy();
	 
				file.ui.cancel.set('html', 'Cancel').removeEvents().addEvent('click', function() {
					file.remove();
					return false;
				});
	 
				this.start();
			}
		});
	 
		up.addEvents({
					'selectSuccess': function(){
						up.onSelectSuccess;
						$('attach_list').setStyle('display', 'none');
						$('new_attach').setStyle('display', 'inline');
					},
					'fileRemove': function(){
						up.onFileRemove;
						$('attach_list').setStyle('display', 'inline');
						$('new_attach').setStyle('display', 'none');
					}
				});
	}
}
 
function filesSubmitForm() {
	// ajax	
	var jsonRequest = new Request.JSON({
		url: ajaxurl, 
		onComplete: function(files){
			$('new_attach').setStyle('display', 'none');
			$('attach').setStyle('display', 'inline');
			$('attach_list').setStyle('display', 'inline');
			files.each(function(file, index){
				filediv = new Element('div', {'class': 'file', id: 'file'+file.id});
				filediv.set('html',  
				"<div class='ico'><img src='"+window.siteurl+"/images/file"+file.type+".gif'></div> \
				<div class='fileinfo'> \
					<div class='del'> \
						<a href='#' onclick='delFile("+file.id+");'><img src='"+window.siteurl+"/images/delete.gif' style='border:none;'></a> \
					</div> \
					<div><a href='"+window.siteurl+"/ajax.php?section=45&f="+file.id+"' style='color:#000'>"+file.filename+"</a></div> \
					<div style='color:#8c8a8a; font-size:11px; line-height:110%'>"+file.comment+"</div> \
					<div style='color:#8c8a8a; font-size:11px; line-height:110%'>"+file.size+" / "+file.date+"</div> \
				</div> \
				<div style='clear:both'></div> \
				");
				filediv.inject($('file-list'), 'top');
			});
			$$('.filetr').dispose();
			up = null;
			createUploader();
			statusMessage($('attach_list'), _('Загрузили успешно!'), {'style':'background:#fdffd3;font-size:11px;text-align:center;padding:5px;margin-bottom:10px;', 'id':'message_ok'});
		}
	}).post($('files-form'));
}

function delFile(id) {
	if (confirm(_('Вы уверены?'))) {
		//ajax
		var jsonRequest = new Request.JSON({
			url: ajaxurl,
			onComplete: function(resp){
				if (resp) {
					$('file'+id).dispose();
					statusMessage($('attach_list'), _('Удалили успешно!'), {'style':'background:#fdffd3;font-size:11px;text-align:center;padding:5px;margin-bottom:10px;', 'id':'message_ok'});
				} else {
					statusMessage($('attach_list'), _('Не удалось удалить файл!'), {'style':'background:#ffd3d5;font-size:11px;text-align:center;padding:5px;margin-bottom:10px;', 'id':'message_fail'});
				}
			}
		}).get({'section': '46', 'f': id});
	}
}

window.addEvent('domready', function() {
	createUploader();
});