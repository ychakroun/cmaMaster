var jsAddLink = null;
function initTags(){
	var collectionHolder;
// setup an "add a tag" link
	var addTagLink = document.createElement("A");
	addTagLink.setAttribute("href", "#");
	addTagLink.setAttribute("class", "add_tag_link");
    addTagLink.innerHTML = jsAddLink;
	var newLinkLi = document.createElement("li");
	newLinkLi.appendChild(addTagLink);
	newLinkLi.setAttribute("id", "jsAddLink");
// Get the ul that holds the collection of tags
	collectionHolder = document.getElementsByClassName('tags');
// add the "add a tag" anchor and li to the tags ul
	if(collectionHolder.length!=0){
		collectionHolder[collectionHolder.length-1].appendChild(newLinkLi);
	}
	var lis = collectionHolder[0].getElementsByTagName("li");
	for(let li of lis){
		if(li.id!="jsAddLink"){
			addTagFormDeleteLink(li);
		}
	}
// count the current form inputs we have (e.g. 2), use that as the new
// index when inserting a new item (e.g. 2)
	collectionHolder[0].setAttribute('index', collectionHolder[0].getElementsByTagName("input").length);
	addTagLink.onclick = function(e) {
    // prevent the link from creating a "#" on the URL
    	e.preventDefault();
    // add a new tag form (see next code block)
    	addTagForm(collectionHolder, newLinkLi);
	};
}
function addTagForm(collectionHolder, newLinkLi) {
// Get the data-prototype explained earlier
	var prototype = collectionHolder[0].getAttribute('data-prototype');
// get the new index
	var index = collectionHolder[0].getAttribute('index');
// Replace '__name__' in the prototype's HTML to
// instead be a number based on how many items we have
	var newForm = prototype.replace(/__name__/g, index);
// increase the index with one for the next item
	collectionHolder[0].setAttribute('index', parseInt(index) + 1);
// Display the form in the page in an li, before the "Add a tag" link li
	var newFormLi = document.createElement("li");
	newFormLi.setAttribute('class',"tagLiCss");
	newFormLi.innerHTML = newFormLi.innerHTML+newForm;
	addTagFormDeleteLink(newFormLi);
	collectionHolder[0].insertBefore(newFormLi, document.getElementById('jsAddLink'));
    var element = collectionHolder[0].getElementsByTagName("label");
    for (index = element.length - 1; index >= 0; index--) {
        element[index].parentNode.removeChild(element[index]);
    }
}
function addTagFormDeleteLink(tagFormLi) {
var removeFormA = document.createElement('a');
removeFormA.innerHTML = "X";
tagFormLi.appendChild(removeFormA);
removeFormA.onclick = function(e) {
    // prevent the link from creating a "#" on the URL
    e.preventDefault();
    // remove the li for the tag form
    tagFormLi.parentNode.removeChild(tagFormLi);
	};
}
function setAddContent(content) {
    jsAddLink = content;
}