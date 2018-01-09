import React     from 'react'
import autoBind  from 'react-autobind'
import Component from '../components'

import { connect }            from 'react-redux'
import { bindActionCreators } from 'redux'
import { CounterProps }       from '../types'

import {
	incAction,
	decAction
} from '../actions'

import {
	Button,
	Segment,
	Header
} from 'semantic-ui-react'

class Counter extends React.Component
{
	constructor(props)
	{
		super(props)
		autoBind(this)
	}

	render() 
	{
		const {
			value,
			incAction,
			decAction
		} = this.props

		return (
			<Segment textAlign='center'>
				<Header size='huge'>Basic Redux Counter</Header>
				<Component value={ value } />
				<Segment basic>
					<Button onClick={ incAction }>INCREMENT</Button>
					<Button onClick={ decAction }>DECREMENT</Button>
				</Segment>
			</Segment>
		)
	}
}

Counter.propTypes = CounterProps

const mapStateToProps = ({ value }) => ({ 
	value 
})

const mapDispatchToProps = dispatch => bindActionCreators({
	incAction,
	decAction
}, dispatch)

export default connect(
	mapStateToProps,
	mapDispatchToProps
)(Counter)