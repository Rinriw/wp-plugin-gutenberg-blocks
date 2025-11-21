import { mkdir, rm, cp, readFile } from 'fs/promises';
import { createWriteStream, existsSync } from 'fs';
import archiver from 'archiver';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';
import { execSync } from 'child_process';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const PLUGIN_SLUG = 'acf-blocks-starter';
const BUILD_DIR = join(__dirname, 'build');
const PLUGIN_DIR = join(BUILD_DIR, PLUGIN_SLUG);

// Archivos y carpetas a incluir
const INCLUDE_PATTERNS = [
  'plugin.php',
  'includes',
  'blocks',
  'acf-json',
  'dist',
  'README.md'
];

async function buildPlugin() {
  try {
    const packageJson = JSON.parse(await readFile('./package.json', 'utf-8'));
    const zipName = `${PLUGIN_SLUG}-v${packageJson.version}.zip`;
    const ZIP_FILE = join(__dirname, zipName);

    console.log(`📦 Compilando plugin: ${zipName}\n`);

    // 1. Compilar Tailwind CSS
    console.log('🎨 Compilando Tailwind CSS...');
    execSync('npm run tailwind:build', { stdio: 'inherit' });
    console.log('✅ CSS compilado\n');

    // 2. Limpiar directorios previos
    console.log('🧹 Limpiando directorios...');
    if (existsSync(BUILD_DIR)) {
      await rm(BUILD_DIR, { recursive: true, force: true });
    }
    if (existsSync(ZIP_FILE)) {
      await rm(ZIP_FILE, { force: true });
    }
    await mkdir(PLUGIN_DIR, { recursive: true });
    console.log('✅ Directorios limpios\n');

    // 3. Copiar archivos
    console.log('📂 Copiando archivos del plugin...');
    for (const pattern of INCLUDE_PATTERNS) {
      const source = join(__dirname, pattern);
      const destination = join(PLUGIN_DIR, pattern);
      
      if (existsSync(source)) {
        await cp(source, destination, { recursive: true });
        console.log(`  ✓ ${pattern}`);
      } else {
        console.log(`  ⚠ ${pattern} no encontrado`);
      }
    }
    console.log('✅ Archivos copiados\n');

    // 4. Crear ZIP
    console.log('📦 Creando archivo ZIP...');
    await createZip(BUILD_DIR, ZIP_FILE);
    console.log(`✅ ZIP creado: ${zipName}\n`);

    // 5. Limpiar build temporal
    console.log('🧹 Limpiando archivos temporales...');
    await rm(BUILD_DIR, { recursive: true, force: true });
    console.log('✅ Limpieza completada\n');

    console.log('🎉 ¡Build completado exitosamente!');
    console.log(`📤 Listo para instalar: ${zipName}\n`);

  } catch (error) {
    console.error('❌ Error al compilar el plugin:', error.message);
    process.exit(1);
  }
}

function createZip(sourceDir, outputFile) {
  return new Promise((resolve, reject) => {
    const output = createWriteStream(outputFile);
    const archive = archiver('zip', {
      zlib: { level: 9 }
    });

    output.on('close', () => {
      const size = (archive.pointer() / 1024).toFixed(2);
      console.log(`  ✓ ${size} KB escritos`);
      resolve();
    });

    archive.on('error', (err) => {
      reject(err);
    });

    archive.on('warning', (err) => {
      if (err.code === 'ENOENT') {
        console.warn('  ⚠ Advertencia:', err);
      } else {
        reject(err);
      }
    });

    archive.pipe(output);
    archive.directory(join(sourceDir, PLUGIN_SLUG), PLUGIN_SLUG);
    archive.finalize();
  });
}

buildPlugin();
