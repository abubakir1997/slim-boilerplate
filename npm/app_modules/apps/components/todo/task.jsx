import React     from 'react'
import PropTypes from 'prop-types'
import Styles 	 from 'styles/todo'
import {
	Segment,
	Header
} from 'semantic-ui-react'

const Task = ({ onClick, completed, text }) => (
	<Segment 
	textAlign='left'
	color='green'
	className={Styles.circular}
	onClick={onClick}  
	tertiary={completed}
	style={{ textDecoration: completed ? 'line-through' : 'none' }}
	inverted>
		<Header as='h3' inverted>
			{text}
		</Header>
	</Segment>
)

Task.propTypes = 
{
	onClick  : PropTypes.func.isRequired,
	completed: PropTypes.bool.isRequired,
	text     : PropTypes.string.isRequired
}

export default Task