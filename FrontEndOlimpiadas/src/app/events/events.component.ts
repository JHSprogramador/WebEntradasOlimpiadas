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
  constructor(private location: Location) {}
  auth!: AuthService;
  service = new ServiceService(this.auth);
  listadeportes: any;
  listaeventos: any;
  listasecciones: any;
  id_deporte: any;
  id_seccion: any;
  id_evento: any;

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
  confirm() {
    this.modal.dismiss(this.name, 'confirm');
  }
  onWillDismiss(event: Event) {
    const ev = event as CustomEvent<OverlayEventDetail<string>>;
    if (ev.detail.role === 'confirm') {
      this.message = `Hello, ${ev.detail.data}!`;
    }
  }

  trackByFn(index: number, seccion: any): string {
    return seccion.id; // Utilizamos seccion.seccion como identificador único
  }

  buy() {}

  isModalOpen = false;
  id: string | undefined;

  setOpen(isOpen: boolean, item: string) {
    if (isOpen === false) {
    } else {
      this.location.go(this.location.path() + '/' + item);
      this.eventos();
      //this.secciones();
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
  path(id: string) {
    this.location.go(this.location.path() + '/' + id);
  }
  public alertInputs: string[] | undefined;
  confirmar(id_evento: string) {
    
    var a = document.getElementById('zona') as HTMLSelectElement;
    var b = document.getElementById('cantidad') as HTMLIonRangeElement;
    var precio = 2;
    console.log(a.value);
    console.log(b.value);
    console.log(this.listasecciones);
    this.listasecciones.forEach((s: any) => {
      if (s.seccion === a.value) {
        precio = s.precio;
        precio = precio * parseInt(b.value.toString());
      }
    });
    if (parseInt(b.value.toString()) > 1) {
      this.alertInputs = [
        'Confirmas la compra de ' +
          b.value +
          ' entradas en la zona ' +
          a.value +
          ' con un valor de ' +
          precio +
          '€',
      ];
    } else {
      this.alertInputs = [
        'Confirmas la compra de ' +
          b.value +
          ' entrada en la zona ' +
          a.value +
          ' con un valor de ' +
          precio +
          '€',
      ];
    }

    this.pushEntrada(id_evento, b.value.toString());
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

  async eventos() {
    try {
      this.id_deporte = this.location.path().split('/').pop();
      this.listaeventos = await this.service.getEventosPorIdDeporte(
        this.id_deporte
      );
      // Verifica la estructura de los datos devueltos
      console.log(this.listaeventos);
      // Realiza operaciones con los datos
      // Por ejemplo, itera sobre los datos
    } catch (error) {
      console.error('Error al obtener o procesar los deportes:', error);
    }
  }

  async secciones(id: string) {
    try {
      this.id_deporte = this.location.path().split('/').pop();
      this.id_evento = id;
      this.listasecciones = await this.service.getSecciones(
        this.id_deporte,
        this.id_evento
      );
      console.log(this.listasecciones);
      // Verifica la estructura de los datos devueltos
      // Realiza operaciones con los datos
      // Por ejemplo, itera sobre los datos
    } catch (error) {
      console.error('Error al obtener o procesar los deportes:', error);
    }
  }
  selectedOption: any;

  onOptionSelect(event: any) {
    if (event.detail.value !== this.selectedOption) {
      this.path(event.detail.value);
      this.selectedOption = event.detail.value;
    }
  }

  async pushEntrada(id_evento: string, cantidad: string) {
    try {
      let path = this.location.path().split('/');
      this.id_seccion = path.pop();
      this.id_deporte = path.pop();
      this.id_evento = id_evento;
      this.listasecciones = await this.service.pushEntrada(
        this.id_deporte,
        this.id_evento,
        this.id_seccion,
        cantidad
      );
      // Verifica la estructura de los datos devueltos
      // Realiza operaciones con los datos
      // Por ejemplo, itera sobre los datos
    } catch (error) {
      console.error('Error al obtener o procesar los deportes:', error);
    }
  }
}
