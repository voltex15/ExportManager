import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-export-list',
  templateUrl: './export-list.component.html',
  styleUrls: ['./export-list.component.css']
})
export class ExportListComponent implements OnInit {

  @Input() exports;
  displayedColumns: string[] = ['name', 'date', 'time', 'symbol'];
  constructor() { }

  ngOnInit(): void {
  }

}
