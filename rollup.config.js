import md5 from 'md5';
import fs from 'fs-extra';
import path from 'node:path';
import babel from '@rollup/plugin-babel';
import alias from '@rollup/plugin-alias';
import filesize from 'rollup-plugin-filesize';
import { terser } from 'rollup-plugin-terser';
import commonjs from '@rollup/plugin-commonjs';
import resolve from '@rollup/plugin-node-resolve';
import outputManifest from 'rollup-plugin-output-manifest';

export default {
  input: 'builds/cdn.js',
  output: {
    format: 'umd',
    sourcemap: true,
    name: 'tall-toast',
    file: 'dist/js/tall-toast.js'
  },
  plugins: [
    resolve(),
    commonjs({
      include: /node_modules\/(get-value|isobject|core-js)/
    }),
    filesize(),
    terser({
      mangle: false,
      compress: {
        drop_debugger: false
      }
    }),
    babel({
      exclude: 'node_modules/**'
    }),
    alias({
      entries: [
        { find: '@', replacement: path.resolve('resources/js') }
      ]
    }),
    // Mimic Laravel Mix's mix-manifest file for auto-cache-busting.
    outputManifest({
      serialize () {
        const file = fs.readFileSync(path.resolve('dist/js/tall-toast.js'), 'utf8');
        const hash = md5(file).substr(0, 20);

        return JSON.stringify({
          '/tall-toast.js': '/tall-toast.js?id=' + hash
        });
      }
    })
  ]
};
