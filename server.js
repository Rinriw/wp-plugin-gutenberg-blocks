import { spawn } from 'child_process';
import { writeFileSync, existsSync } from 'fs';
import { dirname, join } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));

console.log('🚀 Iniciando WordPress con Playground...\n');

// Crear archivo blueprint.json temporal
const blueprint = {
  preferredVersions: {
    php: '8.0',
    wp: '6.7'
  },
  steps: [
    {
      step: 'login',
      username: 'admin',
      password: 'password'
    },
    {
      step: 'installPlugin',
      pluginZipFile: {
        resource: 'url',
        url: 'https://connect.advancedcustomfields.com/v2/plugins/download?p=pro&k=YOUR_ACF_LICENSE_KEY'
      }
    },
    {
      step: 'activatePlugin',
      pluginPath: 'advanced-custom-fields-pro'
    },
    {
      step: 'setSiteOptions',
      options: {
        permalink_structure: '/%postname%/'
      }
    }
  ]
};

// Guardar blueprint temporal
const blueprintPath = join(__dirname, '.playground-blueprint.json');
writeFileSync(blueprintPath, JSON.stringify(blueprint, null, 2));

// Ejecutar wp-playground CLI
const wpPlayground = spawn('npx', [
  '@wp-playground/cli',
  'server',
  '--blueprint=' + blueprintPath,
  '--port=8888',
  '--mount=' + __dirname + ':/wordpress/wp-content/plugins/acf-blocks-starter'
], {
  stdio: 'inherit',
  shell: true
});

wpPlayground.on('spawn', () => {
  console.log('✅ WordPress Playground iniciado!\n');
  console.log('📍 URLs:');
  console.log('   Sitio:  http://localhost:8888');
  console.log('   Admin:  http://localhost:8888/wp-admin');
  console.log('\n🔐 Credenciales:');
  console.log('   Usuario:    admin');
  console.log('   Contraseña: password');
  console.log('\n💡 Presiona Ctrl+C para detener\n');
});

wpPlayground.on('error', (error) => {
  console.error('❌ Error al iniciar WordPress Playground:', error.message);
  process.exit(1);
});

wpPlayground.on('exit', (code) => {
  if (code !== 0 && code !== null) {
    console.error(`\n❌ WordPress Playground finalizó con código ${code}`);
  }
  process.exit(code || 0);
});

// Limpiar al salir
process.on('SIGINT', () => {
  console.log('\n\n👋 Deteniendo WordPress Playground...');
  wpPlayground.kill('SIGINT');
  process.exit(0);
});
