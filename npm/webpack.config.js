// ------------------------------------------------------
// ********************* Enviroment *********************
// ------------------------------------------------------

const isProduction  = process.env.NODE_ENV == 'production'
const isDevelopment = process.env.NODE_ENV == 'development' 

const env = JSON.stringify(process.env.NODE_ENV)

// ------------------------------------------------------
// ********************* Modules ************************
// ------------------------------------------------------

const path    = require('path');
const glob    = require("glob");
const webpack = require('webpack');
const extract = require('extract-text-webpack-plugin');
const purify  = require('purifycss-webpack');


// ------------------------------------------------------
// ********************* Paths **************************
// ------------------------------------------------------

const dir =
{
	dist   : path.resolve(__dirname, '../public'),
	src    : path.resolve(__dirname, 'app'),
	modules: path.resolve(__dirname, 'app_modules'),
	bundled:
	{
		styles: '../../styles/bundled'
	}
};

const js =
{
	dist: path.resolve(dir.dist, 'scripts/bundled'),
	src : path.resolve(dir.src , '*.jsx')
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
		localIdentName: isProduction ? '[hash:base64]' : '[name]__[local]--[hash:base64:5]'
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
	purify:
	{
		minimize: true,
		paths: glob.sync(path.join(js.dist, '*'), { nodir: true }),
		purifyOptions:
		{
			info: true,
			minify: true
		}
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
		'process.env':
		{
			'NODE_ENV': env
		}
	}
};


// ------------------------------------------------------
// ********************* Loaders ************************
// ------------------------------------------------------
const loaders =
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
				use : extract.extract(loaders.styles)
			},
			{
				test: /\.sass$/,
				use : extract.extract(loaders.sass)
			}
		]
	},
	resolve:
	{
		modules   : [dir.modules, 'node_modules'],
		extensions: ['.jsx', '.js', '.css']
	},
	plugins:
	[
		new webpack.optimize.UglifyJsPlugin(plugins.scripts),
		new webpack.HashedModuleIdsPlugin(),
		new webpack.DefinePlugin(plugins.config),
		new extract(plugins.styles),
		//new purify(plugins.purify)
	]
};