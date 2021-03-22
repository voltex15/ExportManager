import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-export',
  templateUrl: './export.component.html',
  styleUrls: ['./export.component.css']
})
export class ExportComponent implements OnInit {

  @Input() exports;

  constructor() { }

  ngOnInit(): void {
  }

}
