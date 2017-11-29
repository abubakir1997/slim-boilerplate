const reducer = (state = 1, action) =>
{
	switch(action.type)
	{
		case 'INC': return state + 1
		case 'DEC': return state <= 0 ? 0 : state - 1
		default   : return state
	}
}

export default reducer