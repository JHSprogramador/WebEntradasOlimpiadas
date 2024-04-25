import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { ViewChild } from '@angular/core';
import { IonModal } from '@ionic/angular';
import { OverlayEventDetail } from '@ionic/core/components';
import { NgModel } from '@angular/forms';
import { text } from 'ionicons/icons';
import { AuthService } from '@auth0/auth0-angular';
import { ServiceService } from '../service.service';

type Evento = {
  id: string;
  description: string;
  eventos: any;
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
  listadeportes:any;
  ngOnInit() {
  }
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
  // listaDeEventos: Evento[] = [
    // {
      // id: '1',
      // description: 'La Kinli',
      // eventos: 
        // [
          // {
            // id: '1',
            // ronda: 'Final'
          // },
          // {
            // id: '2',
            // ronda: 'Semifinal-1'
          // },
          // {
            // id: '3',
            // ronda: 'Semifinal-2'
          // },
          // {
            // id: '4',
            // ronda: 'Cuartos de final'
          // }
        // ]
    // },
    // {
      // id: '2',
      // description: 'Baloncesto',
      // eventos: {

      // }
    // },
    // {
      // id: '3',
      // description: 'Hokey',
      // eventos: {

      // }
    // },
  // ];
  buy() {}

  
  isModalOpen = false;
  id:string | undefined;

  setOpen(isOpen: boolean, item:string) {
    console.log(item)
    this.id = item
    this.isModalOpen = isOpen;
  }
  public alertButtons = [{
    text: 'Cancel',
    role: 'cancel',
    handler: () => {
      console.log('Alert canceled');
    },
  },
  {
    text: 'OK',
    role: 'confirm',
    handler: () => {
      console.log('Alert confirmed');
    },
  },
];
  public alertInputs: string[] | undefined;
  confirmar(){
    var a = document.getElementById('zona') as HTMLSelectElement
    var b = document.getElementById('cantidad') as HTMLIonRangeElement
    console.log(a.value)
    console.log(b.value)
    if(parseInt(b.value.toString())>1){
      this.alertInputs = ["Confirmas la compra de " + b.value + " entradas en la zona " + a.value];
    }else{
      this.alertInputs = ["Confirmas la compra de " + b.value + " entrada en la zona " + a.value];
    }
    
  }
}
  