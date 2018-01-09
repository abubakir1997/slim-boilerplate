import React from 'react'

import { HugeText } from '../styles'
import { Segment }  from 'semantic-ui-react'

const Counter = ({ value }) =>
(
	<Segment basic className={ HugeText }>{ value }</Segment>
)

export default Counter