function functionTimer () {
	this.saved_fn = {};
}

functionTimer.prototype.add = function (name, fn) {
	this.saved_fn[name] = fn;
};

functionTimer.prototype.remove = function (name) {
	delete this.saved_fn[name];
}

functionTimer.prototype.reseat = function (name, fn) {
	if (typeof this.saved_fn[name] !== 'undefined') {
		clearTimeout(this.saved_fn[name]);
		this.remove(name);
	}
	this.add(name, fn);
}