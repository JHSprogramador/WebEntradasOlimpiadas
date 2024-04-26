import { DOCUMENT, CommonModule } from '@angular/common';
import { Component, Inject, OnInit } from '@angular/core';
import { AuthService } from '@auth0/auth0-angular';
import { IonicModule } from '@ionic/angular';
import { ServiceService, User } from '../service.service';

@Component({
  selector: 'app-profile-info',
  templateUrl: './profile-info.component.html',
  styleUrls: ['./profile-info.component.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})
export class ProfileInfoComponent  implements OnInit {

  isAuthenticated$ = this.auth.isAuthenticated$;

  user!: User;

  fecha1!: string;
  fecha2!: string;

  constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService, private service: ServiceService) { }

  ngOnInit() {
    // Mostrar usuario obtenido
    this.service.getUser().then(user => {
      if (user) {
        this.user = user;
        this.setDates(this.user);
      }
    });
  }

  setDates(user: User) {
    // Obtener la fecha actual
    var fecha = new Date();
    var numeroSemana1 = user.mes1;
    var numeroSemana2 = user.mes2;

    // Obtener el día y el mes de la semana 1
    var diaMes1: number;
    var mes1: number;
    ({ dia: diaMes1, mes: mes1 } = this.getDayAndMonthDate(numeroSemana1, fecha.getFullYear()));

    // Obtener el día y el mes de la semana 2
    var diaMes2: number;
    var mes2: number;
    ({ dia: diaMes2, mes: mes2 } = this.getDayAndMonthDate(numeroSemana2, fecha.getFullYear()));

    // Mostrar la fecha de la semana 1
    this.fecha1 = diaMes1 + ' ' + this.getMonthAbbreviation(mes1);

    // Mostrar la fecha de la semana 2
    this.fecha2 = diaMes2 + ' ' + this.getMonthAbbreviation(mes2);
  }

  getMonthAbbreviation(mes1: number) {
    var meses = [
      'Ene',
      'Feb',
      'Mar',
      'Abr',
      'May',
      'Jun',
      'Jul',
      'Ago',
      'Sep',
      'Oct',
      'Nov',
      'Dic',
    ];
    return meses[mes1 - 1];
  }

  getDayAndMonthDate(numeroSemana:number, anyo:number) {
    var diaMesYMes2 = this.obtenerDiaMesYMes(numeroSemana, anyo);
    var dia = diaMesYMes2.diaMes;
    var mes = diaMesYMes2.mes;
    return { dia, mes };
  }

  obtenerDiaMesYMes(numeroSemana: number, año: number) {
    // Crear una nueva instancia de Date
    var fecha = new Date(año, 0, 1 + (numeroSemana - 1) * 7);

    // Ajustar la fecha al primer día de la semana (lunes)
    fecha.setDate(fecha.getDate() - fecha.getDay() + 1);

    // Obtener el día del mes
    var diaMes = fecha.getDate();

    // Obtener el mes
    var mes = fecha.getMonth() + 1; // Se agrega 1 ya que los meses en JavaScript van de 0 a 11

    return {
        diaMes: diaMes,
        mes: mes
    };
  }
}
