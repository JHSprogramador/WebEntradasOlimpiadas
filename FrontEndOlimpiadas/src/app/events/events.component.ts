import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
type Evento = {
  id: string;
  description: string;
};
@Component({
  selector: 'app-events',
  templateUrl: './events.component.html',
  styleUrls: ['./events.component.scss'],
  standalone: true,
  imports: [CommonModule, IonicModule, EventsComponent],
})
export class EventsComponent implements OnInit {
  constructor() {}
  listaDeEventos: Evento[] = [
    {
      id: '1',
      description: 'Descripción del evento 1',
    },
    {
      id: '2',
      description: 'Descripción del evento 2',
    },
    {
      id: '3',
      description: 'Descripción del evento 3',
    },
  ];
  buy() {
    alert('buena compra manin');
  }
  ngOnInit() {}
}
