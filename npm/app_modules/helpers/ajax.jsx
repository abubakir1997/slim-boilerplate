import axios from 'axios'

export default axios.create({
	baseURL: localStorage.getItem('base'),
	headers: {
		'Authorization'   : localStorage.getItem('jwtToken'),
		'X-CSRFToken'     : localStorage.getItem('csrfToken'),
		'X-CSRFKey'       : localStorage.getItem('csrfKey'),
		'X-Requested-With': 'XMLHttpRequest'
	}
})