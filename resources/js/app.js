import.meta.glob([ '../images/**', ]);

import {livewire_hot_reload} from 'virtual:livewire-hot-reload'
import Alpine from 'alpinejs';

livewire_hot_reload();

window.Alpine = Alpine;

Alpine.start();
