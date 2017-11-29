// ------------------------------------------------------
// ********************* Modules ************************
// ------------------------------------------------------

const path 	  = require('path');
const glob 	  = require("glob");
const webpack = require('webpack');
const extract = require('extract-text-webpack-plugin');


// ------------------------------------------------------
// ********************* Paths **************************
// ------------------------------------------------------

const dir = 
{
	dist   : path.resolve(__dirname, '../public'),
	src    : path.resolve(__dirname, 'app_modules'),
	bundled: 
	{ 
		styles: '../../styles/bundled' 
	}
};

const js = 
{
	dist: path.resolve(dir.dist, 'scripts/bundled'),
	src : path.resolve(dir.src , 'build/*.jsx')
};


// ------------------------------------------------------
// ********************* JSX ****************************
// ------------------------------------------------------

const entry = glob.sync(js.src)
	.reduce((x, y) =>
		Object.assign(x, {
			[y.replace(/.*\//g, '').replace(/\.jsx/, '')]: y,
		})
	, {})
;

// ------------------------------------------------------
// ********************* Options ************************
// ------------------------------------------------------
const options = 
{
	style: 
	{
		minimize      : true,
		modules       : true,
		localIdentName: '[hash:base64:5]_[name]_[local]'
	}
};


// ------------------------------------------------------
// ********************* Plugins ************************
// ------------------------------------------------------
const plugins = 
{
	styles: 
	{
		filename : dir.bundled.styles + '/[name].min.css?[hash]',
		disable  : false,
		allChunks: true
	},
	scripts: 
	{
		compress: 
		{
			warnings    : false,
			screw_ie8   : true,
			conditionals: true,
			unused      : true,
			comparisons : true,
			sequences   : true,
			dead_code   : true,
			evaluate    : true,
			if_return   : true,
			join_vars   : true
		},
		output: 
		{
			comments: false
		}
	},
	config:
	{
		'process.env': {
			'NODE_ENV': JSON.stringify('development')
		}
	}
};


// ------------------------------------------------------
// ********************* Extensions *********************
// ------------------------------------------------------
const extensions = 
{
	styles: 
	{
		fallback  : "style-loader",
		publicPath: dir.src,
		use:
		[
			{
				loader : "css-loader",
				options: options.style
			},
			'cssimportant-loader'
		]
	},
	sass: 
	{
		fallback  : "style-loader",
		publicPath: dir.src,
		use:
		[
			{
				loader : "sass-loader",
				options: options.style
			}
		]
	}
};


// ------------------------------------------------------
// ********************* Exports ************************
// ------------------------------------------------------

module.exports = {
	entry,
	devtool: 'source-map',
	output : 
	{
		path         : js.dist,
		filename     : '[name].min.js?[hash]',
		chunkFilename: '[id].min.js?[hash]'
	},
	module: 
	{
		loaders: 
		[
			{
				test   : /\.jsx?$/,
				exclude: /node_modules/,
				include: dir.src,
				loader : 'babel-loader'
			},
			{
				test: /\.css$/,
				use : extract.extract(extensions.styles)
			},
			{
				test: /\.sass$/,
				use : extract.extract(extensions.sass)
			}
		]
	},
	resolve: 
	{
		modules   : ['node_modules', dir.src],
		extensions: ['.jsx', '.js', '.css']
	},
	plugins: 
	[
		new extract(plugins.styles),
		new webpack.optimize.UglifyJsPlugin(plugins.scripts),
		new webpack.HashedModuleIdsPlugin(),
		new webpack.DefinePlugin(plugins.config)
	]
};