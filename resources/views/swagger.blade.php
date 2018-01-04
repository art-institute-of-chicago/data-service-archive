{
  "swagger": "2.0",
  "info": {
    "title": "Art Institution of Chicago Institutional Image Archive API",
    "description": "An API for the institutional image archive of the Art Institute of Chicago",
    "termsOfService": "",
    "contact": {
      "email": "museumtechnology@artic.edu"
    },
    "license": {
      "name": ""
    },
    "version": "0.1"
  },
  "host": "{{ $host }}",
  "basePath": "/v1",
  "schemes": [
    "http"
  ],
  "paths": {
    "/archival-images": {
      "get": {
        "tags": [
            "archival-images"
        ],
        "summary": "A list of all archival images sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/ArchivalImage"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },

    "/archival-images/{id}": {
      "get": {
        "tags": [
            "archival-images"
        ],
        "summary": "A single archival image by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/ArchivalImage"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
  },

  "definitions": {
    "Error": {
      "required": [
        "status",
        "error",
        "detail"
      ],
      "properties": {
        "status": {
          "type": "integer"
        },
        "error": {
          "type": "string"
        },
        "detail": {
          "type": "string"
        }
      }
    },

    "ArchivalImage": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the image"
        },
        "alternate_title": {
          "description": "Alternate name of the image"
        },
        "web_url": {
          "description": "URL to this image on the archive website"
        },
        "collection": {
          "description": "Name of the collection this image is a part of"
        },
        "archive": {
          "description": "Name of the archive within this collection this image is a part of"
        },
        "format": {
          "description": "Physical format of the photograph"
        },
        "file_format": {
          "description": "Format of the digital file"
        },
        "file_size": {
          "description": "Number representing the size of the file in bytes"
        },
        "pixel_dimension": {
          "description": "Dimensions of the digital image"
        },
        "color": {
          "description": "Color type. Values include Color, B&W and Toned"
        },
        "physical_notes": {
          "description": "Notes about the photograph"
        },
        "date": {
          "description": "Date of photograph"
        },
        "date_object": {
          "description": "Date the subject of the photograph was designed or built"
        },
        "date_view": {
          "description": ""
        },
        "creator": {
          "description": "Name of the architect, designer or creator"
        },
        "additional_creator": {
          "description": "Name of an additional architect, designer or creator"
        },
        "photographer": {
          "description": "Name of person who took the photograph"
        },
        "main_id": {
          "description": "Unique identifier used by the Archives for this image"
        },
        "legacy_image_id": {
          "description": "Unique identifier used by Imaging for this image. Most of the these numbers of using their legacy ID schema."
        },
        "subject_terms": {
          "description": "Array of subject terms this image is tagged with"
        },
        "view": {
          "description": "View of the object in the image"
        },
        "image_notes": {
          "description": "Image description"
        },
        "file_name": {
          "description": "Name of the digital image file"
        },
        "created_at": {
          "description": "Date the source record was created"
        },
        "modified_at": {
          "description": "Date the source record was modified"
        }
      },
      "type": "object"
    }
  },
  "parameters": {
    "id": {
      "name": "id",
      "in": "path",
      "type": "string",
      "required": true
    },
    "ids": {
      "name": "ids",
      "in": "query",
      "type": "string"
    },
    "limit": {
      "name": "limit",
      "in": "query",
      "type": "integer"
    },
    "page": {
      "name": "page",
      "in": "query",
      "type": "integer"
    },
    "q": {
      "name": "query",
      "in": "query",
      "type": "string"
    },
    "facets": {
      "name": "facets",
      "in": "query",
      "type": "string"
    }
  },
  "externalDocs": {
    "description": "Find out more about open source at the Art Institute of Chicago",
    "url": "http://www.github.com/art-insititute-of-chicago"
  }
}
