import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SearchExportsFormComponent } from './search-exports-form.component';

describe('SearchExportsFormComponent', () => {
  let component: SearchExportsFormComponent;
  let fixture: ComponentFixture<SearchExportsFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SearchExportsFormComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SearchExportsFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
