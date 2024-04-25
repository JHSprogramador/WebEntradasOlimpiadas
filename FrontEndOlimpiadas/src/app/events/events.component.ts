import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { ViewChild } from '@angular/core';
import { IonModal } from '@ionic/angular';
import { OverlayEventDetail } from '@ionic/core/components';
import { NgModel } from '@angular/forms';
import { location, text } from 'ionicons/icons';
import { AuthService } from '@auth0/auth0-angular';
import { ServiceService } from '../service.service';
import { Location } from '@angular/common';


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
  
  constructor(private location:Location) {}
  auth!: AuthService;
  service = new ServiceService(this.auth);
  listadeportes: any;
  listaeventos: any;
  ngOnInit() {
    this.deportes();
  }
  @ViewChild(IonModal)
  modal!: IonModal;

  message =
    'This modal example uses triggers to automatically open a modal when the button is clicked.';
  name!: string;

  cancel() {
    this.modal.dismiss(null, 'cancel');
  }

  async deportes() {
    try {
      this.listadeportes = await this.service.getDeportes();
      // Verifica la estructura de los datos devueltos
      console.log(this.listadeportes);
      // Realiza operaciones con los datos
      // Por ejemplo, itera sobre los datos
    } catch (error) {
      console.error('Error al obtener o procesar los deportes:', error);
    }
  }
  async eventos(id:string) {
    try {
      this.listadeportes = await this.service.getEventosPorIdDeporte(id);
      // Verifica la estructura de los datos devueltos
      console.log(this.listadeportes);
      // Realiza operaciones con los datos
      // Por ejemplo, itera sobre los datos
    } catch (error) {
      console.error('Error al obtener o procesar los deportes:', error);
    }
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
  buy() {}

  isModalOpen = false;
  id: string | undefined;

  setOpen(isOpen: boolean, item: string) {
    if(isOpen ===false){
    }else{
      this.location.replaceState(this.location.path()+"/" +item);
    }
    console.log(item);
    this.id = item;
    this.isModalOpen = isOpen;
  }
  public alertButtons = [
    {
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
  confirmar() {
    var a = document.getElementById('zona') as HTMLSelectElement;
    var b = document.getElementById('cantidad') as HTMLIonRangeElement;
    console.log(a.value);
    console.log(b.value);
    if (parseInt(b.value.toString()) > 1) {
      this.alertInputs = [
        'Confirmas la compra de ' + b.value + ' entradas en la zona ' + a.value,
      ];
    } else {
      this.alertInputs = [
        'Confirmas la compra de ' + b.value + ' entrada en la zona ' + a.value,
      ];
    }
  }
}
