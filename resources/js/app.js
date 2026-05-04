import './bootstrap';

import Alpine from 'alpinejs';
import { initLoader } from './loader';

window.Alpine = Alpine;

Alpine.start();

// Initialize 3D Loading Screen
initLoader();
