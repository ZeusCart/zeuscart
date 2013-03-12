/**
* GNU General Public License.

* This file is part of ZeusCart V4

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
// JavaScript Document
//Show the help windoe
function ShowHelp(img, title, desc)
	{
		img = document.getElementById(img);
		div = document.createElement('div');
		div.id = 'help';

		div.style.display = 'inline';
		div.style.position = 'absolute';
		div.style.width = '190px';
		div.style.backgroundColor = 'rgb(255,255,225)';
		div.style.border = 'solid black 1px';
		div.style.padding = '5px';
		div.innerHTML = '<span style="font-family:Arial, Helvetica, sans-serif;font-size:12px;"><strong>' + title + '<\/strong><\/span><br/><div style="font-family:Arial, Helvetica, sans-serif; font-size:11px;color:#000000; font-weight:normal" >' + desc + '<\/div>';

		//img.parentNode.appendChild(div);
		var parent = img.parentNode;
		if(img.nextSibling)
			parent.insertBefore(div, img.nextSibling);
		else
			parent.appendChild(div)
	}
//Hide the help window
function HideHelp(img)
{
	img = document.getElementById(img);
	div = document.getElementById('help');
	if (div) {
		img.parentNode.removeChild(div);
	}
}