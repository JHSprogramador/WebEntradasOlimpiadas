import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { ViewChild } from '@angular/core';
import { IonModal } from '@ionic/angular';
import { OverlayEventDetail } from '@ionic/core/components';
import { NgModel } from '@angular/forms';

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
  @ViewChild(IonModal)
  modal!: IonModal;

  message =
    'This modal example uses triggers to automatically open a modal when the button is clicked.';
  name!: string;

  cancel() {
    this.modal.dismiss(null, 'cancel');
  }

  confirm() {
    this.modal.dismiss(this.name, 'confirm');
  }

  onWillDismiss(event: Event) {
    const ev = event as CustomEvent<OverlayEventDetail<string>>;
    if (ev.detail.role === 'confirm') {
      this.message = `Hello, ${ev.detail.data}!`;
    }
  }
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
  buy() {}

  ngOnInit() {}
}
