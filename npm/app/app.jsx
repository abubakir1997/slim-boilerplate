import React      from 'react'
import Ajax 	  from 'helpers/ajax'
import { render } from 'react-dom'

import { 
	Popup,
	Statistic,
	Image,
	Button,
	Icon
} from 'semantic-ui-react'

const AppProfile =
(
	<a>
		<Statistic size='mini' inverted>
			<Statistic.Value>
				<center>	
					<Image
					src={ '/images/user.png' } 
					className='white circular' 
					size='mini' />
				</center>
			</Statistic.Value>
			<Statistic.Label>USER</Statistic.Label>
		</Statistic>
	</a>
)

const row = { marginBottom: 5 }
const App =
(
	<Popup trigger={ AppProfile } position="bottom center" on='click'>
		<Popup.Content>
			<div>
		    	<div style={ row }>
					<Button as='a' href="" circular fluid>
						<Icon name='user' />
						Profile
					</Button>
			    </div>
			    <div>
			    	<Button 
			    	as='a' 
			    	color='red' 
			    	href='/signout' 
			    	onClick={ localStorage.clear() }
			    	circular >
						<Icon name='sign out' />
						Log Out
					</Button>
					<Button as='a' href="" icon circular>
						<Icon name='setting' />
					</Button>
			    </div>
		    </div>
		</Popup.Content>
	</Popup>
)

render(App, document.getElementById('app-profile'))