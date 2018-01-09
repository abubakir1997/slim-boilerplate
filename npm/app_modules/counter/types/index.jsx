import PropTypes from 'prop-types'

export const CounterProps = {
	value: PropTypes.number.isRequired,

	// Actions 
	incAction: PropTypes.func.isRequired,
	decAction: PropTypes.func.isRequired
}