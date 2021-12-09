import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.data('muCosPosters', () => ({
	height: 36,
	width: 48,
	estimates: '',

	init() {
		fetch('https://netapps.marshall.edu/cosweb/posters/getPrices.php?w=98&h=36')
		.then(
			data => { return data.json(); }
		)
		.then(
			programJson => {
				this.estimates = programJson.estimates;
				this.height = programJson.height;
				this.width = programJson.width; }
			)
	},
}))

Alpine.start()
