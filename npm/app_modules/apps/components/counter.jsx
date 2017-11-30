import React  from 'react'
import Styles from 'styles/counter'
import {
	Segment,
	Header,
	Button,
	Icon
} from 'semantic-ui-react'

export default class Counter extends React.Component 
{
	render()
	{
		return (
			<div>
				<Segment textAlign='center' inverted>
					<Header as='h1' inverted>Positive Counter</Header>
					<div className='ui divider'></div>
					<Header as='h1' className={Styles.header} inverted>{ this.props.state }</Header>
					<Button onClick={ this.props.onDec} circular icon>
						<Icon name='minus' />
					</Button>
					<Button onClick={ this.props.onInc} circular icon>
						<Icon name='plus' />
					</Button>
				</Segment>
				<Segment textAlign='center' secondary>
				 	<p>Components are implemented using ReactJS and Redux</p>
				</Segment>
			</div>
		);
	}
}